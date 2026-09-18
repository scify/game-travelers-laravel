<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * The board's debug strip stages a game through POST debug/game/{game_id}/state.
 * The route exists only in a local installation with APP_DEBUG on.
 */
class DebugGameStateTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function state_route_answers_not_found_outside_local_debug(): void
    {
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->postJson(route('debug.game.state', $game->id), ['pos1' => 13])
            ->assertNotFound();

        $this->assertDatabaseHas('games', ['id' => $game->id, 'location_1' => 0]);
    }

    #[Test]
    public function owner_stages_position_phase_and_next_roll(): void
    {
        $this->enableDebugMode();
        $game = $this->startedGame($this->seededPlayer(), ['active' => false]);

        $this->actingAs($this->seededUser())
            ->postJson(route('debug.game.state', $game->id), ['pos1' => 13, 'phase' => 1, 'next' => 17, 'turn' => false])
            ->assertOk()
            ->assertJsonPath('location_1', 13)
            ->assertJsonPath('latest_random_result', 17);

        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'location_1' => 13,
            'game_phase' => 1,
            'latest_random_result' => 17,
            'first_player_turn' => false,
            'active' => true,
        ]);
    }

    #[Test]
    public function staging_stores_card_in_latest_random_result(): void
    {
        $this->enableDebugMode();
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->postJson(route('debug.game.state', $game->id), ['pos1' => 15, 'phase' => 2, 'card' => -4])
            ->assertOk();

        $this->assertDatabaseHas('games', ['id' => $game->id, 'location_1' => 15, 'game_phase' => 2, 'latest_random_result' => -4]);
    }

    #[Test]
    public function staging_rejects_phase_outside_range(): void
    {
        $this->enableDebugMode();
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->postJson(route('debug.game.state', $game->id), ['phase' => 4])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['phase']);
    }

    #[Test]
    public function game_owned_by_another_user_cannot_be_staged(): void
    {
        $this->enableDebugMode();
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededAdmin())
            ->postJson(route('debug.game.state', $game->id), ['pos1' => 13])
            ->assertForbidden();

        $this->assertDatabaseHas('games', ['id' => $game->id, 'location_1' => 0]);
    }

    #[Test]
    public function board_page_passes_state_url_in_local_debug(): void
    {
        $this->enableDebugMode();
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->get(route('board', [1, $game->id]))
            ->assertOk()
            ->assertSee(route('debug.game.state', $game->id));
    }

    #[Test]
    public function board_page_omits_state_url_outside_local_debug(): void
    {
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->get(route('board', [1, $game->id]))
            ->assertOk()
            ->assertDontSee('debug-state-url');
    }

    // Laravel skips CSRF verification only while the environment is testing; with env local the check is real and not what these tests examine.
    private function enableDebugMode(): void
    {
        $this->app->instance('env', 'local');
        config()->set('app.debug', true);
        $this->withoutMiddleware(PreventRequestForgery::class);
    }
}

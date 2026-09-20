<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PlayerSelectionTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function selection_page_lists_players_of_user(): void
    {
        $this->actingAs($this->seededUser())
            ->get(route('select.player', [0, 0]))
            ->assertOk()
            ->assertSee('Κώστας Παπ.')
            ->assertSee('Νίκη Καραγ.');
    }

    #[Test]
    public function starting_without_active_game_goes_to_board_selection(): void
    {
        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 0]), ['player' => 1, 'submit' => 'start'])
            ->assertRedirect(route('select.board', [1, 0]));
    }

    #[Test]
    public function starting_with_started_game_offers_to_continue_it(): void
    {
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 0]), ['player' => 1, 'submit' => 'start'])
            ->assertRedirect(route('select.continue', [1, $game->id]));
    }

    #[Test]
    public function starting_with_unstarted_game_discards_it_and_goes_to_board_selection(): void
    {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false]);

        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 0]), ['player' => 1, 'submit' => 'start'])
            ->assertRedirect(route('select.board', [1, 0]));

        $this->assertDatabaseMissing('games', ['id' => $game->id]);
    }

    #[Test]
    public function starting_with_player_owned_by_another_user_is_forbidden(): void
    {
        $player = $this->seededPlayer();
        $game = $this->startedGame($player, ['started' => false]);

        $this->actingAs(User::factory()->create())
            ->post(route('select.player', [0, 0]), ['player' => $player->id, 'submit' => 'start'])
            ->assertForbidden();

        $this->assertDatabaseHas('games', ['id' => $game->id]);
    }

    #[Test]
    public function settings_button_opens_player_settings(): void
    {
        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 0]), ['player' => 1, 'submit' => 'settings'])
            ->assertRedirect(route('settings.index', [1, 'user', 0]));
    }

    #[Test]
    public function unknown_action_is_forbidden(): void
    {
        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 0]), ['player' => 1, 'submit' => 'bogus'])
            ->assertForbidden();
    }
}

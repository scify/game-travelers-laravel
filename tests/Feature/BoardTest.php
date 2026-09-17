<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * The board's Vue component talks to the backend through POST board/fromVue.
 * game_phase 1 asks for a dice roll, game_phase 2 reports the move, game_phase 3 reports a card's move.
 */
class BoardTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function board_page_renders_for_game_owner(): void
    {
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->get(route('board', [1, $game->id]))
            ->assertOk()
            ->assertSee('<board-component', false);
    }

    #[Test]
    public function dice_roll_moves_target_one_to_six_squares_and_is_stored(): void
    {
        $game = $this->startedGame($this->seededPlayer());

        $response = $this->actingAs($this->seededUser())
            ->postJson(route('to.backend'), $this->payload($game->id))
            ->assertOk()
            ->assertJson(['gameEnded' => 0]);

        $newPosition = $response->json('newPosition');
        $this->assertGreaterThanOrEqual(1, $newPosition);
        $this->assertLessThanOrEqual(6, $newPosition);
        $this->assertSame($newPosition, $response->json('diceResult'));
        $this->assertDatabaseHas('games', ['id' => $game->id, 'game_phase' => 1, 'latest_random_result' => $newPosition]);
    }

    #[Test]
    public function repeated_dice_roll_returns_stored_result(): void
    {
        $game = $this->startedGame($this->seededPlayer(), ['game_phase' => 1, 'latest_random_result' => 4]);

        $this->actingAs($this->seededUser())
            ->postJson(route('to.backend'), $this->payload($game->id))
            ->assertOk()
            ->assertJson(['gameEnded' => 0, 'newPosition' => 4, 'diceResult' => 4]);
    }

    #[Test]
    public function move_to_plain_square_is_stored_and_turn_stays_with_solo_player(): void
    {
        // Square 4 has colour 4: no card.
        $game = $this->startedGame($this->seededPlayer(), ['game_phase' => 1, 'latest_random_result' => 4]);

        $this->actingAs($this->seededUser())
            ->postJson(route('to.backend'), $this->payload($game->id, ['game_phase' => 2, 'location_1' => 4]))
            ->assertOk()
            ->assertJson(['gameEnded' => 0, 'drawCard' => 0, 'firstPlayerTurn' => true]);

        $this->assertDatabaseHas('games', ['id' => $game->id, 'game_phase' => 2, 'location_1' => 4, 'latest_random_result' => 0]);
    }

    #[Test]
    public function move_to_card_square_draws_card(): void
    {
        // Squares with colour 3 or 5 draw a card; square 3 is one of them.
        $game = $this->startedGame($this->seededPlayer(), ['game_phase' => 1, 'latest_random_result' => 3]);

        $response = $this->actingAs($this->seededUser())
            ->postJson(route('to.backend'), $this->payload($game->id, ['game_phase' => 2, 'location_1' => 3]))
            ->assertOk()
            ->assertJson(['gameEnded' => 0]);

        $this->assertNotSame(0, $response->json('drawCard'));
        $this->assertDatabaseHas('games', ['id' => $game->id, 'game_phase' => 2, 'location_1' => 3, 'latest_random_result' => $response->json('drawCard')]);
    }

    #[Test]
    public function reaching_last_square_ends_game(): void
    {
        $game = $this->startedGame($this->seededPlayer(), ['game_phase' => 1, 'latest_random_result' => 30, 'location_1' => 27]);

        $this->actingAs($this->seededUser())
            ->postJson(route('to.backend'), $this->payload($game->id, ['game_phase' => 2, 'location_1' => 30]))
            ->assertOk()
            ->assertJson(['gameEnded' => 1]);

        $this->assertDatabaseHas('games', ['id' => $game->id, 'active' => 0, 'location_1' => 30]);
    }

    #[Test]
    public function user_cannot_play_game_owned_by_another_user(): void
    {
        $otherPlayer = Player::create(['user_id' => 1, 'name' => 'Ξένος', 'avatar_id' => 1]);
        $otherGame = $this->startedGame($otherPlayer);

        $this->actingAs($this->seededUser())
            ->postJson(route('to.backend'), $this->payload($otherGame->id, ['player_id' => $otherPlayer->id]))
            ->assertForbidden();
    }

    #[Test]
    public function unknown_game_is_reported_as_not_found(): void
    {
        // The controller answers 302 with a message, not 404. Kept as is: the Vue component relies on the body.
        $this->actingAs($this->seededUser())
            ->postJson(route('to.backend'), $this->payload(999))
            ->assertStatus(302)
            ->assertJson(['message' => 'Game not found']);
    }

    /**
     * The payload the Vue component sends, for a solo game on the island board with a normal die.
     *
     * @param  array<string, int>  $overrides
     *
     * @return array<string, int>
     */
    private function payload(int $gameId, array $overrides = []): array
    {
        return array_merge([
            'player_id' => 1,
            'game_id' => $gameId,
            'first_player_turn' => 1,
            'location_1' => 0,
            'location_2' => 0,
            'dice_type' => 1,
            'game_phase' => 1,
            'difficulty' => 1,
            'game_mode' => 1,
            'board_id' => 1,
        ], $overrides);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameSetupTest extends TestCase {
    use RefreshDatabase;

    protected $seed = true;

    public function test_the_full_setup_flow_creates_a_playable_solo_game(): void {
        $user = $this->seededUser();

        // Board.
        $response = $this->actingAs($user)
            ->post(route('select.board', [1, 'board', 0]), ['board' => 1]);
        $game = Game::where('player_id', 1)->firstOrFail();
        $response->assertRedirect(route('select.mode', [1, 'mode', $game->id]));
        $this->assertDatabaseHas('games', ['id' => $game->id, 'user_id' => 2, 'board_id' => 1, 'active' => 1, 'started' => 0]);

        // Mode: solo.
        $this->actingAs($user)
            ->post(route('select.mode', [1, 'mode', $game->id]), ['mode' => 1])
            ->assertRedirect(route('select.pawn', [1, 'pawn', $game->id]));
        $this->assertDatabaseHas('games', ['id' => $game->id, 'mode_id' => 1]);

        // Pawn: solo mode skips the second pawn.
        $this->actingAs($user)
            ->post(route('select.pawn', [1, 'pawn', $game->id]), ['pawn' => 1])
            ->assertRedirect(route('select.options', [1, 'option', $game->id]));
        $this->assertDatabaseHas('games', ['id' => $game->id, 'pawn_id_1' => 1]);

        // Options: play without the tutorial.
        $this->actingAs($user)
            ->post(route('select.options', [1, 'option', $game->id]), ['option' => 2])
            ->assertRedirect(route('board', [1, $game->id]));
        $this->assertDatabaseHas('games', ['id' => $game->id, 'use_tutorial' => 0, 'started' => 1, 'selected_board_size' => 2]);

        // The board renders the Vue component.
        $this->actingAs($user)
            ->get(route('board', [1, $game->id]))
            ->assertOk()
            ->assertSee('<board-component', false);
    }

    public function test_a_two_player_game_asks_for_the_second_pawn(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false, 'mode_id' => 2, 'pawn_id_1' => 0, 'pawn_id_2' => 0]);

        $this->actingAs($this->seededUser())
            ->post(route('select.pawn', [1, 'pawn', $game->id]), ['pawn' => 1])
            ->assertRedirect(route('select.pawnTwo', [1, 'pawn-two', $game->id]));

        $this->actingAs($this->seededUser())
            ->post(route('select.pawnTwo', [1, 'pawn-two', $game->id]), ['pawn' => 2])
            ->assertRedirect(route('select.options', [1, 'option', $game->id]));

        $this->assertDatabaseHas('games', ['id' => $game->id, 'pawn_id_1' => 1, 'pawn_id_2' => 2]);
    }

    public function test_choosing_the_tutorial_is_remembered(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false]);

        $this->actingAs($this->seededUser())
            ->post(route('select.options', [1, 'option', $game->id]), ['option' => 1])
            ->assertRedirect(route('board', [1, $game->id]));

        $this->assertDatabaseHas('games', ['id' => $game->id, 'use_tutorial' => 1, 'started' => 1]);
    }

    public function test_setup_pages_of_a_started_game_redirect_to_the_board(): void {
        $game = $this->startedGame($this->seededPlayer());

        foreach (['select.board' => 'board', 'select.mode' => 'mode', 'select.pawn' => 'pawn', 'select.options' => 'option'] as $route => $from) {
            $this->actingAs($this->seededUser())
                ->get(route($route, [1, $from, $game->id]))
                ->assertRedirect(route('board', [1, $game->id]));
        }
    }

    public function test_selecting_a_board_reuses_the_players_active_game(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false, 'board_id' => 2]);

        $this->actingAs($this->seededUser())
            ->post(route('select.board', [1, 'board', 0]), ['board' => 3])
            ->assertRedirect(route('select.mode', [1, 'mode', $game->id]));

        $this->assertSame(1, Game::where('player_id', 1)->count());
        $this->assertDatabaseHas('games', ['id' => $game->id, 'board_id' => 3]);
    }
}

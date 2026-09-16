<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerSelectionTest extends TestCase {
    use RefreshDatabase;

    protected $seed = true;

    public function test_the_selection_page_lists_the_users_players(): void {
        $this->actingAs($this->seededUser())
            ->get(route('select.player', [0, 'user', 0]))
            ->assertOk()
            ->assertSee('Κώστας Παπ.')
            ->assertSee('Νίκη Καραγ.');
    }

    public function test_starting_with_no_active_game_goes_to_board_selection(): void {
        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 'user', 0]), ['player' => 1, 'submit' => 'start'])
            ->assertRedirect(route('select.board', [1, 'board', 0]));
    }

    public function test_starting_with_a_started_game_offers_to_continue_it(): void {
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 'user', 0]), ['player' => 1, 'submit' => 'start'])
            ->assertRedirect(route('select.continue', [1, 'continue', $game->id]));
    }

    public function test_starting_with_an_unstarted_game_discards_it_and_goes_to_board_selection(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false]);

        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 'user', 0]), ['player' => 1, 'submit' => 'start'])
            ->assertRedirect(route('select.board', [1, 'board', 0]));

        $this->assertDatabaseMissing('games', ['id' => $game->id]);
    }

    public function test_the_settings_button_goes_to_the_players_settings(): void {
        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 'user', 0]), ['player' => 1, 'submit' => 'settings'])
            ->assertRedirect(route('settings', [1, 'user', 0]));
    }

    public function test_an_unknown_action_is_forbidden(): void {
        $this->actingAs($this->seededUser())
            ->post(route('select.player', [0, 'user', 0]), ['player' => 1, 'submit' => 'bogus'])
            ->assertForbidden();
    }
}

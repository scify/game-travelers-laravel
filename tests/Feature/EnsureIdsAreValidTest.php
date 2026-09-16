<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnsureIdsAreValidTest extends TestCase {
    use RefreshDatabase;

    protected $seed = true;

    public function test_a_player_id_of_zero_passes_through(): void {
        $this->actingAs($this->seededUser())
            ->get(route('new.player', [0, 'user', 0]))
            ->assertOk();
    }

    public function test_an_unknown_player_is_forbidden(): void {
        $this->actingAs($this->seededUser())
            ->get(route('settings', [999, 'user', 0]))
            ->assertForbidden();
    }

    public function test_another_users_player_is_forbidden(): void {
        $this->actingAs($this->seededAdmin())
            ->get(route('select.board', [1, 'board', 0]))
            ->assertForbidden();
    }

    public function test_another_users_game_is_forbidden(): void {
        $adminsPlayer = Player::create(['user_id' => 1, 'name' => 'Άρης', 'avatar_id' => 1]);
        $adminsGame = $this->startedGame($adminsPlayer);

        $this->actingAs($this->seededUser())
            ->get(route('select.mode', [1, 'mode', $adminsGame->id]))
            ->assertForbidden();
    }

    public function test_an_inactive_own_game_is_redirected_to_board_selection(): void {
        $finished = $this->startedGame($this->seededPlayer(), ['active' => false]);

        $this->actingAs($this->seededUser())
            ->get(route('select.mode', [1, 'mode', $finished->id]))
            ->assertRedirect(route('select.board', [1, 'board', 0]));
    }
}

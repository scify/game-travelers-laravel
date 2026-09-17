<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EnsureIdsAreValidTest extends TestCase {
    use LazilyRefreshDatabase;

    protected $seed = true;

    #[Test]
    public function player_id_zero_passes_through(): void {
        $this->actingAs($this->seededUser())
            ->get(route('new.player', [0, 'user', 0]))
            ->assertOk();
    }

    #[Test]
    public function unknown_player_is_forbidden(): void {
        $this->actingAs($this->seededUser())
            ->get(route('settings', [999, 'user', 0]))
            ->assertForbidden();
    }

    #[Test]
    public function player_owned_by_another_user_is_forbidden(): void {
        $this->actingAs($this->seededAdmin())
            ->get(route('select.board', [1, 'board', 0]))
            ->assertForbidden();
    }

    #[Test]
    public function game_owned_by_another_user_is_forbidden(): void {
        $otherPlayer = Player::create(['user_id' => 1, 'name' => 'Ξένος', 'avatar_id' => 1]);
        $otherGame = $this->startedGame($otherPlayer);

        $this->actingAs($this->seededUser())
            ->get(route('select.mode', [1, 'mode', $otherGame->id]))
            ->assertForbidden();
    }

    #[Test]
    public function inactive_own_game_redirects_to_board_selection(): void {
        $finished = $this->startedGame($this->seededPlayer(), ['active' => false]);

        $this->actingAs($this->seededUser())
            ->get(route('select.mode', [1, 'mode', $finished->id]))
            ->assertRedirect(route('select.board', [1, 'board', 0]));
    }
}

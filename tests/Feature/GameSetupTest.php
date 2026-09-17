<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GameSetupTest extends TestCase {
    use LazilyRefreshDatabase;

    protected $seed = true;

    /**
     * @return array<string, array{route: string, from: string}>
     */
    public static function setupPageProvider(): array {
        return [
            'board' => ['route' => 'select.board', 'from' => 'board'],
            'mode' => ['route' => 'select.mode', 'from' => 'mode'],
            'pawn' => ['route' => 'select.pawn', 'from' => 'pawn'],
            'options' => ['route' => 'select.options', 'from' => 'option'],
        ];
    }

    #[Test]
    public function selecting_board_creates_game_and_asks_for_mode(): void {
        $response = $this->actingAs($this->seededUser())
            ->post(route('select.board', [1, 'board', 0]), ['board' => 1]);

        $game = Game::where('player_id', 1)->firstOrFail();
        $response->assertRedirect(route('select.mode', [1, 'mode', $game->id]));
        $this->assertDatabaseHas('games', ['id' => $game->id, 'user_id' => 2, 'board_id' => 1, 'active' => 1, 'started' => 0]);
    }

    #[Test]
    public function selecting_solo_mode_asks_for_pawn(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false, 'mode_id' => 2]);

        $this->actingAs($this->seededUser())
            ->post(route('select.mode', [1, 'mode', $game->id]), ['mode' => 1])
            ->assertRedirect(route('select.pawn', [1, 'pawn', $game->id]));

        $this->assertDatabaseHas('games', ['id' => $game->id, 'mode_id' => 1]);
    }

    #[Test]
    public function selecting_pawn_in_solo_mode_skips_second_pawn(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false, 'mode_id' => 1, 'pawn_id_1' => 0, 'pawn_id_2' => 0]);

        $this->actingAs($this->seededUser())
            ->post(route('select.pawn', [1, 'pawn', $game->id]), ['pawn' => 1])
            ->assertRedirect(route('select.options', [1, 'option', $game->id]));

        $this->assertDatabaseHas('games', ['id' => $game->id, 'pawn_id_1' => 1]);
    }

    #[Test]
    public function selecting_pawn_in_two_player_mode_asks_for_second_pawn(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false, 'mode_id' => 2, 'pawn_id_1' => 0, 'pawn_id_2' => 0]);

        $this->actingAs($this->seededUser())
            ->post(route('select.pawn', [1, 'pawn', $game->id]), ['pawn' => 1])
            ->assertRedirect(route('select.pawnTwo', [1, 'pawn-two', $game->id]));

        $this->assertDatabaseHas('games', ['id' => $game->id, 'pawn_id_1' => 1]);
    }

    #[Test]
    public function selecting_second_pawn_asks_for_options(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false, 'mode_id' => 2, 'pawn_id_1' => 1, 'pawn_id_2' => 0]);

        $this->actingAs($this->seededUser())
            ->post(route('select.pawnTwo', [1, 'pawn-two', $game->id]), ['pawn' => 2])
            ->assertRedirect(route('select.options', [1, 'option', $game->id]));

        $this->assertDatabaseHas('games', ['id' => $game->id, 'pawn_id_1' => 1, 'pawn_id_2' => 2]);
    }

    #[Test]
    public function declining_tutorial_starts_game_and_opens_board(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false, 'use_tutorial' => true, 'selected_board_size' => 1]);

        $this->actingAs($this->seededUser())
            ->post(route('select.options', [1, 'option', $game->id]), ['option' => 2])
            ->assertRedirect(route('board', [1, $game->id]));

        $this->assertDatabaseHas('games', ['id' => $game->id, 'use_tutorial' => 0, 'started' => 1, 'selected_board_size' => 2]);
    }

    #[Test]
    public function choosing_tutorial_is_remembered(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false]);

        $this->actingAs($this->seededUser())
            ->post(route('select.options', [1, 'option', $game->id]), ['option' => 1])
            ->assertRedirect(route('board', [1, $game->id]));

        $this->assertDatabaseHas('games', ['id' => $game->id, 'use_tutorial' => 1, 'started' => 1]);
    }

    #[Test]
    #[DataProvider('setupPageProvider')]
    public function setup_page_of_started_game_redirects_to_board(string $route, string $from): void {
        $game = $this->startedGame($this->seededPlayer());

        $this->actingAs($this->seededUser())
            ->get(route($route, [1, $from, $game->id]))
            ->assertRedirect(route('board', [1, $game->id]));
    }

    #[Test]
    public function selecting_board_reuses_active_game_of_player(): void {
        $game = $this->startedGame($this->seededPlayer(), ['started' => false, 'board_id' => 2]);

        $this->actingAs($this->seededUser())
            ->post(route('select.board', [1, 'board', 0]), ['board' => 3])
            ->assertRedirect(route('select.mode', [1, 'mode', $game->id]));

        $this->assertSame(1, Game::where('player_id', 1)->count());
        $this->assertDatabaseHas('games', ['id' => $game->id, 'board_id' => 3]);
    }
}

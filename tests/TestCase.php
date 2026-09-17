<?php

namespace Tests;

use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use Illuminate\Foundation\Mix;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\HtmlString;

abstract class TestCase extends BaseTestCase {
    protected function setUp(): void {
        parent::setUp();

        // Views call mix() for CSS and JS. Tests run without a front-end build,
        // so return the plain path instead of reading public/mix-manifest.json.
        $this->app->instance(Mix::class, new class {
            public function __invoke(string $path, string $manifestDirectory = ''): HtmlString {
                return new HtmlString($manifestDirectory . $path);
            }
        });
    }

    /** The seeded administrator (id 1, admin-taxidiotes@scify.org). */
    protected function seededAdmin(): User {
        return User::findOrFail(1);
    }

    /** The seeded registered user (id 2, user-taxidiotes@scify.org) who owns the two seeded players. */
    protected function seededUser(): User {
        return User::findOrFail(2);
    }

    /** The first seeded player of the seeded user (id 1, "Κώστας Παπ."). */
    protected function seededPlayer(): Player {
        return Player::findOrFail(1);
    }

    /** A game for the given player, ready to be played. Override any column through $attributes. */
    protected function startedGame(Player $player, array $attributes = []): Game {
        return Game::create(array_merge([
            'user_id' => $player->user_id,
            'player_id' => $player->id,
            'board_id' => 1,
            'mode_id' => 1,
            'pawn_id_1' => 1,
            'pawn_id_2' => 2,
            'use_tutorial' => false,
            'location_1' => 0,
            'location_2' => 0,
            'active' => true,
            'first_player_turn' => true,
            'started' => true,
            'selected_board_size' => 2,
            'game_phase' => 0,
            'latest_random_result' => 0,
        ], $attributes));
    }
}

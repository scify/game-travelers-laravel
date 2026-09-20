<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\SetupStep;
use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected PlayerRepository $playerRepository, protected GameRepository $gameRepository) {}

    public function show(Request $request, int $player_id, int $game_id): Factory|View
    {
        $user_id = auth()->user()->id;
        $players = $this->playerRepository->allWhere(['user_id' => $user_id]);
        $players_info = [];
        foreach ($players as $player) {
            $player_info = [
                'id' => $player->id,
                'user_id' => $player->user_id,
                'name' => $player->name,
                'avatar_id' => $player->avatar_id,
            ];
            $players_info[] = $player_info;
        }

        return view('gameSelectPlayer', ['players' => $players_info, 'avatars' => $this->playerRepository->getAvatars()]);
    }

    public function select(Request $request, int $player_id, int $game_id)
    {
        $selected_player_id = (int) $request->only('player')['player'];
        $action = $request->only('submit')['submit'];
        // This page chooses a player, so the route carries none and the guard
        // middleware has nothing to check. The chosen player is checked here.
        abort_if(
            $selected_player_id !== 0 && ! $this->playerRepository->playerExists($selected_player_id, (int) auth()->id()),
            403,
            __('messages.unauthorized_action')
        );
        if ($action === 'start') {
            $active_games = $this->gameRepository->allWhere(['player_id' => $selected_player_id, 'active' => true], ['id', 'started']);
            if ($active_games->isEmpty()) {
                return to_route('select.board', ['player_id' => $selected_player_id, 'game_id' => 0]);
            }

            $active_game_id = $active_games[0]->id;
            if ($active_games[0]->started) {
                return to_route('select.continue', ['player_id' => $selected_player_id, 'game_id' => $active_game_id]);
            }

            $this->gameRepository->delete($active_game_id);

            return to_route('select.board', ['player_id' => $selected_player_id, 'game_id' => 0]);

        }

        if ($action === 'settings') {
            return to_route('settings.index', ['player_id' => $selected_player_id, 'back' => SetupStep::User, 'game_id' => 0]);
        }

        abort(403, __('messages.unauthorized_action'));

    }
}

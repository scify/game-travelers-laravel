<?php

namespace App\Http\Controllers;

use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class SetupGameController extends Controller
{
    protected PlayerRepository $playerRepository;
    protected GameRepository $gameRepository;

    public function __construct(PlayerRepository $playerRepository, GameRepository $gameRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->gameRepository = $gameRepository;
    }

    public function continueShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }
        $players = $this->playerRepository->allWhere(['id' => $player_id]);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        View::share('avatarName', $avatarName);
        View::share('playerName', $name);
        View::share('showSettings', true);
        $switcher = $this->getSwitcher($players);
        return view('gameSelectExisting', ['switcher' => $switcher]);
    }

    public function continueSave(Request $request, int $player_id, string $from, int $game_id)
    {

        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }
        $selected = (int) $request->only('option')['option'];

        if ($selected == 1) {
            $entry = ['active' => false];
            $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
            return Redirect::route('select.board', [$player_id, 'board', 0]);
        } else {
            return Redirect::route('board', [$player_id, $game_id]);
        }
    }

    public function boardShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        if ($this->checkIfActiveGameHasStarted($game_id)) {
            return Redirect::route('board', [$player_id, $game_id]);
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id]);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        View::share('avatarName', $avatarName);
        View::share('playerName', $name);
        View::share('showSettings', true);
        $boards = $this->gameRepository->getBoards();
        $switcher = $this->getSwitcher($players);
        return view('gameSelectBoard', ['switcher' => $switcher, 'boards' => $boards]);
    }

    public function boardSave(Request $request, int $player_id, string $from, int $game_id)
    {

        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $user_id = auth()->user()->id;
        $selected_board_id = (int) $request->only('board')['board'];
        $entry = ['user_id' => $user_id, 'player_id' => $player_id, 'board_id' => $selected_board_id];
        if ($game_id == 0) {
            //check if an active game already exists
            $active_games = $this->gameRepository->allWhere(['player_id' => $player_id, 'active' => true], ['id']);
            if (sizeof($active_games) == 0) {
                $game = $this->gameRepository->create($entry);
                $game_id = $game->id;
            } else {
                $game_id = $active_games[0]->id;
                $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
            }
        } else {
            $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        }

        return Redirect::route('select.mode', [$player_id, 'mode', $game_id]);
    }

    public function modeShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        if ($this->checkIfActiveGameHasStarted($game_id)) {
            return Redirect::route('board', [$player_id, $game_id]);
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id]);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        View::share('avatarName', $avatarName);
        View::share('playerName', $name);
        View::share('showSettings', true);
        $switcher = $this->getSwitcher($players);
        return view('gameSelectMode', ['switcher' => $switcher]);
    }

    public function modeSave(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $selected_mode_id = (int) $request->only('mode')['mode'];
        $entry = ['mode_id' => $selected_mode_id];
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return Redirect::route('select.pawn', [$player_id, 'pawn', $game_id]);
    }

    public function pawnShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        if ($this->checkIfActiveGameHasStarted($game_id)) {
            return Redirect::route('board', [$player_id, $game_id]);
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id]);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        View::share('avatarName', $avatarName);
        View::share('playerName', $name);
        View::share('showSettings', true);

        $game = $this->gameRepository->allWhere(['id' => $game_id], ['board_id']);
        $board = $game[0]->board_id;
        $pawns = $this->gameRepository->getPawns();
        $switcher = $this->getSwitcher($players);

        return view('gameSelectPawn', ['board' => $board, 'pawns' => $pawns, 'switcher' => $switcher]);
    }

    public function pawnSave(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $selected_pawn_id = (int) $request->only('pawn')['pawn'];
        $entry = ['pawn_id_1' => $selected_pawn_id];
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);

        $game = $this->gameRepository->allWhere(['id' => $game_id], ['mode_id']);
        $mode = $game[0]->mode_id;

        if ($mode == 1) {
            return Redirect::route('select.options', [$player_id, 'option', $game_id]);
        } else {
            return redirect()->route('select.pawnTwo', [$player_id, 'pawn-two', $game_id]);
        }
    }

    public function pawnTwoShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        if ($this->checkIfActiveGameHasStarted($game_id)) {
            return Redirect::route('board', [$player_id, $game_id]);
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id]);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        View::share('avatarName', $avatarName);
        View::share('playerName', $name);
        View::share('showSettings', true);

        $game = $this->gameRepository->allWhere(['id' => $game_id], ['board_id', 'pawn_id_1']);
        $board = $game[0]->board_id;
        $pawns = $this->gameRepository->getPawns();
        $switcher = $this->getSwitcher($players);
        $player_one_pawn_id = $game[0]->pawn_id_1;
        return view(
            'gameSelectPawnTwo',
            ['board' => $board, 'player_one_pawn_id' => $player_one_pawn_id, 'pawns' => $pawns, 'switcher' => $switcher]
        );
    }

    public function pawnTwoSave(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $selected_pawn_id_2 = (int) $request->only('pawn')['pawn'];
        $entry = ['pawn_id_2' => $selected_pawn_id_2];
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return Redirect::route('select.options', [$player_id, 'option', $game_id]);
    }

    public function optionsShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }
        if ($this->checkIfActiveGameHasStarted($game_id)) {
            return Redirect::route('board', [$player_id, $game_id]);
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id]);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        View::share('avatarName', $avatarName);
        View::share('playerName', $name);
        View::share('showSettings', true);

        $switcher = $this->getSwitcher($players);

        return view('gameSelectOptions', ['switcher' => $switcher]);
    }

    public function optionsSave(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id], ['board_size']);
        $board_size = $players[0]->board_size;

        $selected_option = (int) $request->only('option')['option'];
        $tutorial = true;
        if ($selected_option == 2) {
            $tutorial = false;
        }
        $entry = ['use_tutorial' => $tutorial, 'started' => true, 'selected_board_size' => $board_size];
        if ($game_id == null) {
            abort(403, __('messages.unauthorized_action'));
        }
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return Redirect::route('board', [$player_id, $game_id]);
    }

    /**
     * Retrieve Switcher Settings for a player.
     *
     * @param App\Repository\Player\PlayerRepository $players
     *   The player object to retrieve settings for.
     * @return array
     *   An array containing the control mode (1= automatic, 2=manual), scanning
     *   speed, automatic selection button, manual selection button, and manual
     *   navigation button for the player.
     */
    private function getSwitcher($players)
    {
        $switcher = [
            'controlMode' => $players[0]->auto,
            'scanningSpeed' => $players[0]->scanning_speed,
            'automaticSelectionButton' => $players[0]->select_key,
            'manualSelectionButton' => $players[0]->select_key,
            'manualNavigationButton' => $players[0]->navigate_key,
        ];
        return $switcher;
    }

    private function checkIfActiveGameHasStarted($game_id)
    {
        if ($game_id == 0) {
            return false;
        }

        $games = $this->gameRepository->allWhere(['id' => $game_id], ['started']);
        return $games[0]->started;
    }
}

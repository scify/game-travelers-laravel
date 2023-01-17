<?php

namespace App\Http\Controllers;

use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;

class SetupGameController extends Controller
{
    protected PlayerRepository $playerRepository;
    protected GameRepository $gameRepository;

    public function __construct(PlayerRepository $playerRepository, GameRepository $gameRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->gameRepository = $gameRepository;
    }

    public function boardShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0)
            return abort(403, 'Unauthorized action.');
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('gameSelectBoard');
    }

    public function boardSave(Request $request, int $player_id, string $from, int $game_id)
    {

        if ($player_id == 0)
            return abort(403, 'Unauthorized action.');

        $user_id = auth()->user()->id;
        $selected_board_id = (int)$request->only('board')['board'];
        $entry = ['user_id' => $user_id, 'player_id' => $player_id, 'board_id' => $selected_board_id];
        if ($game_id == 0) {
            //check if an active game already exists
            $active_games = $this->gameRepository->allWhere(['user_id'=> $user_id, 'active' => true],['id']);
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

        return \Redirect::route('select.mode', [$player_id, 'mode', $game_id]);

    }

    public function modeShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0)
            return abort(403, 'Unauthorized action.');

        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('gameSelectMode');
    }

    public function modeSave(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0)
            return abort(403, 'Unauthorized action.');

        $selected_mode_id = (int)$request->only('mode')['mode'];
        $entry = ['mode_id' => $selected_mode_id];
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return \Redirect::route('select.pawn', [$player_id, 'pawn', $game_id]);
    }

    public function pawnShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0)
            return abort(403, 'Unauthorized action.');

        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('gameSelectPawn');
    }

    public function pawnSave(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0)
            return abort(403, 'Unauthorized action.');

        $selected_pawn_id = (int)$request->only('pawn')['pawn'];
        $entry = ['pawn_id_1' => $selected_pawn_id];
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return \Redirect::route('select.options', [$player_id, 'options', $game_id]);
    }

    public function optionsShow(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0)
            return abort(403, 'Unauthorized action.');

        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('gameSelectOptions');
    }

    public function optionsSave(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0 || $game_id == 0)
            return abort(403, 'Unauthorized action.');

        $selected_option = (int)$request->only('option')['option'];
        $tutorial = true;
        if ($selected_option == 2)
            $tutorial = false;
        $entry = ['use_tutorial' => $tutorial];
        if ($game_id == null)
            return abort(403, 'Unauthorized action.');
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return \Redirect::route('board', [$player_id, $game_id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Repository\Game\GameRepository;
use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;
use Cookie;

class SetupGameController extends Controller
{
    protected PlayerRepository $playerRepository;
    protected GameRepository $gameRepository;

    public function __construct(PlayerRepository $playerRepository, GameRepository $gameRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->gameRepository = $gameRepository;
    }

    public function boardShow(Request $request)
    {
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return \Redirect::route('select.player');
        Cookie::queue('settingFrom', 'selectBoard', $minute = 120);
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('gameSelectBoard', ['name' => $name, 'player_id' => $player_id]);
    }

    public function boardSave(Request $request)
    {

            $user_id = auth()->user()->id;
            $player_id = (int)$request->cookie('player_id');
            $selected_board_id = (int)$request->only('board')['board'];
            $entry = ['user_id' => $user_id, 'player_id' => $player_id, 'board_id' => $selected_board_id];
            $game_id = $request->cookie('game_id');
            dd($game_id);
            if ($game_id == null) {
                $game = $this->gameRepository->create($entry);
                $game_id = $game->id;
                Cookie::queue('game_id', $game_id, $minute = 120);
            } else {
                $game_id = (int)$game_id;
                $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
            }

        return \Redirect::route('select.mode');

    }

    public function modeShow(Request $request)
    {
        $player_id = $request->cookie('player_id');
        $game_id = $request->cookie('game_id');
        if ($player_id == null || $game_id == null)
            return \Redirect::route('select.player');
        Cookie::queue('settingFrom', 'selectMode', $minute = 120);
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('gameSelectMode', ['name' => $name, 'player_id' => $player_id]);
    }

    public function modeSave(Request $request)
    {
        $game_id = $request->cookie('game_id');
        $selected_mode_id = (int)$request->only('mode')['mode'];
        $entry = ['mode_id' => $selected_mode_id];
        if ($game_id == null)
            return abort(403, 'Unauthorized action.');
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return \Redirect::route('select.pawn');
    }

    public function pawnShow(Request $request)
    {
        $player_id = $request->cookie('player_id');
        $game_id = $request->cookie('game_id');
        if ($player_id == null || $game_id == null)
            return \Redirect::route('select.player');
        Cookie::queue('settingFrom', 'selectPawn', $minute = 120);
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('gameSelectPawn', ['name' => $name, 'player_id' => $player_id]);
    }

    public function pawnSave(Request $request)
    {
        $game_id = $request->cookie('game_id');
        $selected_pawn_id = (int)$request->only('pawn')['pawn'];
        $entry = ['pawn_id_1' => $selected_pawn_id];
        if ($game_id == null)
            return abort(403, 'Unauthorized action.');
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return \Redirect::route('select.options');
    }

    public function optionsShow(Request $request)
    {
        $player_id = $request->cookie('player_id');
        $game_id = $request->cookie('game_id');
        if ($player_id == null || $game_id == null)
            return \Redirect::route('select.player');
        Cookie::queue('settingFrom', 'selectOption', $minute = 120);
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('gameSelectOptions', ['name' => $name, 'player_id' => $player_id]);
    }

    public function optionsSave(Request $request)
    {
        $game_id = $request->cookie('game_id');
        $selected_option = (int)$request->only('option')['option'];
        $tutorial = true;
        if ($selected_option == 2)
            $tutorial = false;
        $entry = ['use_tutorial' => $tutorial];
        if ($game_id == null)
            return abort(403, 'Unauthorized action.');
        $this->gameRepository->updateOrCreate(['id' => $game_id], $entry);
        return \Redirect::route('dummy.logout');
    }
}

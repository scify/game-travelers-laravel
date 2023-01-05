<?php

namespace App\Http\Controllers;

use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;
use Cookie;

class SetupGameController extends Controller
{
    protected PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function show(Request $request)
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
}

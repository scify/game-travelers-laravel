<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;
use Cookie;

class UserController extends Controller
{

    protected PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function show()
    {
        $user_id = auth()->user()->id;
        Cookie::queue(
            Cookie::forget('player_id')
        );
        $players = $this->playerRepository->allWhere(['user_id' => $user_id]);
        $players_info = [];
        foreach ($players as $player) {
            $player_info = [
                'id' => $player->id,
                'user_id' => $player->user_id,
                'name' => $player->name,
                'avatar_id' => $player->avatar_id
            ];
            $players_info[] = $player_info;
        }
        return view('gameSelectPlayer', ['players' => $players_info, 'avatars' => $this->playerRepository->getAvatars()]);
    }

    public function select(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->only('player')['player'];
        $action = $request->only('submit')['submit'];
        if ($action == "start") {

        } else if ($action == "settings") {

        }
    }

    public function newPlayer(Request $request)
    {
        $user_id = auth()->user()->id;
        $name = "";
        $avatar_id = 0;
        $player_id = $request->cookie('player_id');
        if ($player_id != null) {
            $players = $this->playerRepository->allWhere(['user_id' => $user_id, 'id' => $player_id], ['name', 'avatar_id']);
            if (sizeof($players) > 0) {
                $name = $players[0]->name;
                $avatar_id = $players[0]->avatar_id;
            }
        }
        return view('settingsProfileNew', ["name" => $name, "selectedAvatarId" => $avatar_id]);

    }

    public function savePlayer(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->cookie('player_id');
        $input = $request->only('name', 'avatarId');
        $name = trim($input['name']);
        $avatar_id = (int)$input['avatarId'];
        $players = $this->playerRepository->allWhere(['user_id' => $user_id], ['id', 'name']);
        $name_found = false;
        $max_id = 0;
        foreach ($players as $player) {
            if ($player->id != $player_id && $player->name == $name)
                $name_found = true;
            if ($player->id > $max_id)
                $max_id = $player->id;
        }
        if ($player_id == null)
            $player_id = $max_id + 1;
        else
            $player_id = (int)$player_id;
        if ($name_found) {
            return \Redirect::back()->withErrors(['name' => ['exists']]);
        } else {
            $entry = ['id' => $player_id, 'user_id' => $user_id, 'name' => $name, 'avatar_id' => $avatar_id];
            $player = $this->playerRepository->updateOrCreate(['id' => $entry['id'], 'user_id' => $entry['user_id']], $entry);
            Cookie::queue('player_id', $player_id, $minute = 120);
            return $this->controlsConfigure($request);
        }
    }

    public function controlsConfigure(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->cookie('player_id');
        if ($player_id != null) {
            $players = $this->playerRepository->allWhere(['user_id' => $user_id, 'id' => $player_id], ['name', 'avatar_id']);
            if (sizeof($players) > 0) {
            }
        }
        return view('settingsControlsNew');

    }
}

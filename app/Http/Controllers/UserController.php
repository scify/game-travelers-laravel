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
        Cookie::queue('player_id', $player_id, $minute = 120);
        if ($action == "start") {

        } else if ($action == "settings")
            return \Redirect::route('settings');

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
            return \Redirect::route('controls.player');
        }
    }

    public function controlsConfigure(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->cookie('player_id');
        $control_mode = 1;
        $control_auto_select = "Space";
        $control_manual_select = "Space";
        $control_manual_nav = "Enter";
        $help_after_tries = 3;
        $scanning_speed = 2;
        if ($player_id != null) {
            $players = $this->playerRepository->allWhere(['user_id' => $user_id, 'id' => $player_id], ['auto', 'select_key', 'navigate_key', 'help_after_x_mistakes', 'scanning_speed']);
            if (sizeof($players) > 0) {
                $control_mode = $players[0]->auto;
                $control_select = $players[0]->select_key;
                $control_nav = $players[0]->navigate_key;
                if ($control_mode == 1)
                    $control_auto_select = $control_select;
                else if ($control_mode == 2) {
                    $control_manual_select = $control_select;
                    $control_manual_nav = $control_nav;
                }
                $help_after_tries = $players[0]->help_after_x_mistakes;
                $scanning_speed = $players[0]->scanning_speed;
            }
        }
        return view('settingsControlsNew', ["control_mode" => $control_mode, "control_auto_select" => $control_auto_select, "control_manual_select" => $control_manual_select, "control_manual_nav" => $control_manual_nav, "help_after_tries" => $help_after_tries, "scanning_speed" => $scanning_speed]);
    }

    public function controlsSave(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->cookie('player_id');
        $input = $request->only('controlType', 'controlAutomaticSelectionButton', 'controlManualSelectionButton', 'controlManualNavigationButton', 'helpAfterTries', 'scanningSpeed');
        $control_mode = (int)$input['controlType'];
        $control_auto_select = $input['controlAutomaticSelectionButton'];
        $control_manual_select = $input['controlManualSelectionButton'];
        $control_manual_nav = $input['controlManualNavigationButton'];
        $help_after_tries = (int)$input['helpAfterTries'];
        $scanning_speed = (int)$input['scanningSpeed'];
        $select = $control_auto_select;
        if ($control_mode == 2)
            $select = $control_manual_select;
        $entry = ['id' => $player_id, 'user_id' => $user_id, 'auto' => $control_mode, 'select_key' => $select, 'navigate_key' => $control_manual_nav, 'help_after_x_mistakes' => $help_after_tries, 'scanning_speed' => $scanning_speed];
        $player = $this->playerRepository->updateOrCreate(['id' => $entry['id'], 'user_id' => $entry['user_id']], $entry);
        $action = $request->only('submit')['submit'];

        if ($action == "back" || $action == "profile")
            return \Redirect::route('new.player');
        else if ($action == "next" || $action == "save")
            return \Redirect::route('difficulty.player');

    }

    public function difficultyConfigure(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->cookie('player_id');
        $dice_type = 1;
        $board_size = 2;
        $difficulty = 1;
        $movement_mode = 2;
        if ($player_id != null) {
            $players = $this->playerRepository->allWhere(['user_id' => $user_id, 'id' => $player_id], ['dice_type', 'board_size', 'difficulty', 'movement_mode']);
            if (sizeof($players) > 0) {
                $dice_type = $players[0]->dice_type;
                $board_size = $players[0]->board_size;
                $difficulty = $players[0]->difficulty;
                $movement_mode = $players[0]->movement_mode;
            }
        }
        return view('settingsDifficultyNew', ['dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode]);
    }

    public function difficultySave(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->cookie('player_id');
        $input = $request->only('dice', 'gameDuration', 'level', 'movement');
        $dice_type = (int)$input['dice'];
        $board_size = (int)$input['gameDuration'];
        $difficulty = (int)$input['level'];
        $movement_mode = (int)$input['movement'];

        $entry = ['id' => $player_id, 'user_id' => $user_id, 'dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode];
        $player = $this->playerRepository->updateOrCreate(['id' => $entry['id'], 'user_id' => $entry['user_id']], $entry);

        $action = $request->only('submit')['submit'];
        if ($action == "profile")
            return \Redirect::route('new.player');
        else if ($action == "back" || $action == "controls")
            return \Redirect::route('controls.player');
        else if ($action == "save")
            return \Redirect::route('select.player');
    }

    public function settingsShow(Request $request) {
        $user_id = auth()->user()->id;
        $player_id = $request->cookie('player_id');
        $players = $this->playerRepository->allWhere(['user_id' => $user_id, 'id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        return view('settings', [ 'name' => $name, 'player_id' => $player_id]);
    }

    public function settingsSelect(Request $request) {
        $action = $request->only('submit')['submit'];
        if ($action == "back")
            return \Redirect::route('select.player');
    }
}

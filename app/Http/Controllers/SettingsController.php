<?php

namespace App\Http\Controllers;

use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;
use Cookie;

class SettingsController extends Controller
{
    protected PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function settingsShow(Request $request)
    {
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return \Redirect::route('select.player');

        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        return view('settings', ['name' => $name, 'player_id' => $player_id]);
    }

    public function settingsSelect(Request $request)
    {
        $action = $request->only('submit')['submit'];
        if ($action == "back") {
            $settingFrom = $request->cookie('settingFrom');
            if ($settingFrom == null)
                return \Redirect::route('select.player');
            else if ($settingFrom == "userController")
                return \Redirect::route('select.player');
            else if ($settingFrom == "selectBoard")
                return \Redirect::route('select.board');
            else if ($settingFrom == "selectMode")
                return \Redirect::route('select.mode');
            else if ($settingFrom == "selectPawn")
                return \Redirect::route('select.pawn');
            else if ($settingFrom == "selectOption")
                return \Redirect::route('select.options');
            else
                return \Redirect::route('select.player');

        }
        else if ($action == "profile")
            return \Redirect::route('settings.profile');
        else if ($action == "controls")
            return \Redirect::route('settings.controls');
        else if ($action == "difficulty")
            return \Redirect::route('settings.difficulty');
        else if ($action == "deletePlayer") {
            $player_id = $request->cookie('player_id');
            $this->playerRepository->delete($player_id);
            return \Redirect::route('select.player');
        }else
            return abort(403, 'Unauthorized action.');
    }

    public function profileShow(Request $request)
    {
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return \Redirect::route('select.player');
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('settingsProfile', ["name" => $name, "selectedAvatarId" => $avatar_id, 'avatars' => $this->playerRepository->getAvatars()]);
    }

    public function profileSave(Request $request)
    {
        $user_id = auth()->user()->id;
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return \Redirect::route('select.player');
        $input = $request->only('name', 'avatarId');
        $name = trim($input['name']);
        $avatar_id = (int)$input['avatarId'];
        $players = $this->playerRepository->allWhere(['user_id' => $user_id], ['id', 'name']);
        $name_found = false;
        foreach ($players as $player) {
            if ($player->id != $player_id && $player->name == $name)
                $name_found = true;
        }
        if ($name_found) {
            return \Redirect::back()->withErrors(['name' => ['exists']]);
        } else {
            $entry = ['name' => $name, 'avatar_id' => $avatar_id];
            $player = $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
            return \Redirect::route('settings');
        }
    }

    public function controlsShow(Request $request)
    {
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return \Redirect::route('select.player');
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id', 'auto', 'select_key', 'navigate_key', 'help_after_x_mistakes', 'scanning_speed']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        $control_mode = $players[0]->auto;
        $control_auto_select = "Space";
        $control_manual_select = "Space";
        $control_manual_nav = "Enter";
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


        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('settingsControls', ["control_mode" => $control_mode, "control_auto_select" => $control_auto_select, "control_manual_select" => $control_manual_select, "control_manual_nav" => $control_manual_nav, "help_after_tries" => $help_after_tries, "scanning_speed" => $scanning_speed]);
    }

    public function controlsSave(Request $request)
    {
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return \Redirect::route('select.player');
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
        $entry = ['auto' => $control_mode, 'select_key' => $select, 'navigate_key' => $control_manual_nav, 'help_after_x_mistakes' => $help_after_tries, 'scanning_speed' => $scanning_speed];
        $player = $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        return \Redirect::route('settings');
    }

    public function difficultyShow(Request $request)
    {
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return \Redirect::route('select.player');
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id', 'dice_type', 'board_size', 'difficulty', 'movement_mode']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        $dice_type = $players[0]->dice_type;
        $board_size = $players[0]->board_size;
        $difficulty = $players[0]->difficulty;
        $movement_mode = $players[0]->movement_mode;


        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('settingsDifficulty', ['dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode]);
    }

    public function difficultySave(Request $request)
    {
        $player_id = $request->cookie('player_id');
        if ($player_id == null)
            return \Redirect::route('select.player');
        $input = $request->only('dice', 'gameDuration', 'level', 'movement');
        $dice_type = (int)$input['dice'];
        $board_size = (int)$input['gameDuration'];
        $difficulty = (int)$input['level'];
        $movement_mode = (int)$input['movement'];
        $entry = ['dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode];
        $player = $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        return \Redirect::route('settings');
    }
}

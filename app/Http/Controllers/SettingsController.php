<?php

namespace App\Http\Controllers;

use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function settingsShow(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        return view('settings', ['name' => $name, 'player_id' => $player_id]);
    }

    public function settingsSelect(Request $request, int $player_id, string $back_route, int $game_id)
    {
        $action = $request->only('submit')['submit'];
        switch ($action) {
            case "back":
                switch ($back_route) {
                    case "user":
                        return \Redirect::route('select.player', [0, 'user', 0]);
                    case "continue":
                        return \Redirect::route('select.continue', [$player_id, 'continue', $game_id]);
                    case "board":
                        return \Redirect::route('select.board', [$player_id, 'board', $game_id]);
                    case "mode":
                        return \Redirect::route('select.mode', [$player_id, 'mode', $game_id]);
                    case "pawn":
                        return \Redirect::route('select.pawn', [$player_id, 'pawn', $game_id]);
                    case "pawn-two":
                        return \Redirect::route('select.pawnTwo', [$player_id, 'pawn-two', $game_id]);
                    case "option":
                        return \Redirect::route('select.options', [$player_id, 'option', $game_id]);
                    default:
                        return \Redirect::route('select.player', [0, 'user', 0]);
                }
            case "profile":
                return \Redirect::route('settings.profile', [$player_id, $back_route, $game_id]);
            case "controls":
                return \Redirect::route('settings.controls', [$player_id, $back_route, $game_id]);
            case "difficulty":
                return \Redirect::route('settings.difficulty', [$player_id, $back_route, $game_id]);
            case "deletePlayer":
                $this->playerRepository->delete($player_id);
                return \Redirect::route('select.player', [0, 'user', 0]);
            default:
                abort(403, __('messages.unauthorized_action'));
        }
    }

    public function profileShow(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('settingsProfile', ["name" => $name, "selectedAvatarId" => $avatar_id, 'avatars' => $this->playerRepository->getAvatars()]);
    }

    public function profileSave(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $user_id = auth()->user()->id;
        $input = $request->only('name', 'avatarId');
        $name = trim($input['name']);
        $avatar_id = (int) $input['avatarId'];
        $players = $this->playerRepository->allWhere(['user_id' => $user_id], ['id', 'name']);
        $name_found = false;
        foreach ($players as $player) {
            if ($player->id != $player_id && strtolower($player->name) == strtolower($name)) {
                $name_found = true;
            }
        }
        if ($name_found) {
            return \Redirect::back()->withErrors(['name' => ['exists']]);
        } else {
            $entry = ['name' => $name, 'avatar_id' => $avatar_id];
            $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
            return \Redirect::route('settings', [$player_id, $back_route, $game_id]);
        }
    }

    public function controlsShow(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id', 'auto', 'select_key', 'navigate_key', 'help_after_x_mistakes', 'scanning_speed']);
        $name = $players[0]->name;
        $avatar_id = $players[0]->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];
        $control_mode = $players[0]->auto;
        $control_auto_select = "Enter";
        $control_manual_select = "Enter";
        $control_manual_nav = "Space";
        $control_select = $players[0]->select_key;
        $control_nav = $players[0]->navigate_key;
        if ($control_mode == 1) {
            $control_auto_select = $control_select;
        } elseif ($control_mode == 2) {
            $control_manual_select = $control_select;
            $control_manual_nav = $control_nav;
        }
        $help_after_tries = $players[0]->help_after_x_mistakes;
        $scanning_speed = $players[0]->scanning_speed;


        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);
        return view('settingsControls', ['name' => $name, "control_mode" => $control_mode, "control_auto_select" => $control_auto_select, "control_manual_select" => $control_manual_select, "control_manual_nav" => $control_manual_nav, "help_after_tries" => $help_after_tries, "scanning_speed" => $scanning_speed]);
    }

    public function controlsSave(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $input = $request->only('controlType', 'controlAutomaticSelectionButton', 'controlManualSelectionButton', 'controlManualNavigationButton', 'helpAfterTries', 'scanningSpeed');
        $control_mode = (int) $input['controlType'];
        $control_auto_select = $input['controlAutomaticSelectionButton'];
        $control_manual_select = $input['controlManualSelectionButton'];
        $control_manual_nav = $input['controlManualNavigationButton'];
        $help_after_tries = (int) $input['helpAfterTries'];
        $scanning_speed = (int) $input['scanningSpeed'];
        $select = $control_auto_select;
        if ($control_mode == 2) {
            $select = $control_manual_select;
        }
        $entry = ['auto' => $control_mode, 'select_key' => $select, 'navigate_key' => $control_manual_nav, 'help_after_x_mistakes' => $help_after_tries, 'scanning_speed' => $scanning_speed];
        $player = $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        return \Redirect::route('settings', [$player_id, $back_route, $game_id]);
    }

    public function difficultyShow(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            return \Redirect::route('select.player', [0, 'user', 0]);
        }
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
        return view('settingsDifficulty', ['name' => $name, 'dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode]);
    }

    public function difficultySave(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        $input = $request->only('dice', 'gameDuration', 'level', 'movement');
        $dice_type = (int) $input['dice'];
        $board_size = (int) $input['gameDuration'];
        $difficulty = (int) $input['level'];
        $movement_mode = (int) $input['movement'];
        $entry = ['dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode];
        $player = $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        return \Redirect::route('settings', [$player_id, $back_route, $game_id]);
    }
}

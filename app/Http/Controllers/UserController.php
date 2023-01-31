<?php

namespace App\Http\Controllers;

use App\Repository\Player\PlayerRepository;
use App\Repository\Game\GameRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected PlayerRepository $playerRepository;
    protected GameRepository $gameRepository;

    public function __construct(PlayerRepository $playerRepository, GameRepository $gameRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->gameRepository = $gameRepository;
    }

    public function show(Request $request, int $player_id, string $from, int $game_id)
    {
        $user_id = auth()->user()->id;
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

    public function select(Request $request, int $player_id, string $from, int $game_id)
    {
        $player_id = $request->only('player')['player'];
        $action = $request->only('submit')['submit'];
        if ($action == "start") {
            $active_games = $this->gameRepository->allWhere(['player_id' => $player_id, 'active' => true], ['id', 'started']);
            if (sizeof($active_games) == 0)
                return \Redirect::route('select.board', ['player_id' => $player_id, 'from' => "board", 'game_id' => 0]);
            else {
                $game_id = $active_games[0]->id;
                if ($active_games[0]->started)
                    return \Redirect::route('select.continue', ['player_id' => $player_id, 'from' => "continue", 'game_id' => $game_id]);
                else {
                    $this->gameRepository->delete($game_id);
                    return \Redirect::route('select.board', ['player_id' => $player_id, 'from' => "board", 'game_id' => 0]);
                }
            }
        } else if ($action == "settings")
            return \Redirect::route('settings', ['player_id' => $player_id, 'from' => "user", 'game_id' => 0]);
        else
            abort(403, __('messages.unauthorized_action'));

    }

    public function newPlayer(Request $request, int $player_id, string $from, int $game_id)
    {
        $name = "";
        $avatar_id = 0;
        if ($player_id != 0) {
            $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
            if (sizeof($players) > 0) {
                $name = $players[0]->name;
                $avatar_id = $players[0]->avatar_id;
            }
        }
        return view('settingsProfileNew', ["name" => $name, "selectedAvatarId" => $avatar_id, 'avatars' => $this->playerRepository->getAvatars()]);

    }

    public function savePlayer(Request $request, int $player_id, string $from, int $game_id)
    {
        $user_id = auth()->user()->id;
        $input = $request->only('name', 'avatarId');
        $name = trim($input['name']);
        $avatar_id = (int)$input['avatarId'];
        $players = $this->playerRepository->allWhere(['user_id' => $user_id], ['id', 'name']);
        $name_found = false;
        foreach ($players as $player) {
            if ($player->id != $player_id && strtolower($player->name) == strtolower($name))
                $name_found = true;
        }
        if ($name_found) {
            return \Redirect::back()->withErrors(['name' => ['exists']]);
        } else {
            if ($player_id == 0) {
                $entry = ['user_id' => $user_id, 'name' => $name, 'avatar_id' => $avatar_id];
                $player = $this->playerRepository->create($entry);
                $player_id = $player->id;
            } else {
                $entry = ['name' => $name, 'avatar_id' => $avatar_id];
                $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
            }
            return \Redirect::route('controls.player', [$player_id, $from , 0]);
        }
    }

    public function controlsConfigure(Request $request, int $player_id, string $from, int $game_id)
    {
        if ($player_id == 0)
            abort(403, __('messages.unauthorized_action'));
        $control_mode = 1;
        $control_auto_select = "Space";
        $control_manual_select = "Space";
        $control_manual_nav = "Enter";
        $help_after_tries = 3;
        $scanning_speed = 2;
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['auto', 'select_key', 'navigate_key', 'help_after_x_mistakes', 'scanning_speed']);
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
        return view('settingsControlsNew', ["control_mode" => $control_mode, "control_auto_select" => $control_auto_select, "control_manual_select" => $control_manual_select, "control_manual_nav" => $control_manual_nav, "help_after_tries" => $help_after_tries, "scanning_speed" => $scanning_speed]);
    }

    public function controlsSave(Request $request, int $player_id, string $from, int $game_id = 0)
    {
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
        $action = $request->only('submit')['submit'];

        if ($action == "back" || $action == "profile")
            return \Redirect::route('new.player', [$player_id, $from, 0]);
        else if ($action == "next" || $action == "save")
            return \Redirect::route('difficulty.player', [$player_id, $from, 0]);
        else
            abort(403, __('messages.unauthorized_action'));

    }

    public function difficultyConfigure(Request $request, int $player_id, string $from, int $game_id = 0)
    {
        if ($player_id == 0)
            abort(403, __('messages.unauthorized_action'));
        $dice_type = 1;
        $board_size = 2;
        $difficulty = 1;
        $movement_mode = 2;
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['dice_type', 'board_size', 'difficulty', 'movement_mode']);
        if (sizeof($players) > 0) {
            $dice_type = $players[0]->dice_type;
            $board_size = $players[0]->board_size;
            $difficulty = $players[0]->difficulty;
            $movement_mode = $players[0]->movement_mode;
        }
        return view('settingsDifficultyNew', ['dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode]);
    }

    public function difficultySave(Request $request, int $player_id, string $from, int $game_id = 0)
    {
        $input = $request->only('dice', 'gameDuration', 'level', 'movement');
        $dice_type = (int)$input['dice'];
        $board_size = (int)$input['gameDuration'];
        $difficulty = (int)$input['level'];
        $movement_mode = (int)$input['movement'];

        $entry = ['dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode];
        $player = $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        $action = $request->only('submit')['submit'];
        if ($action == "profile")
            return \Redirect::route('new.player', [$player_id, $from, 0]);
        else if ($action == "back" || $action == "controls")
            return \Redirect::route('controls.player', [$player_id, $from, 0]);
        else if ($action == "save")
            return \Redirect::route('select.player', [0, $from, 0]);
        else
            abort(403, __('messages.unauthorized_action'));
    }

}

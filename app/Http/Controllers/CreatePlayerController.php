<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\Player\PlayerRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * The new player wizard: the same three panels SettingsController edits.
 */
class CreatePlayerController extends Controller
{
    public function __construct(protected PlayerRepository $playerRepository) {}

    public function profileShow(Request $request, ?int $player_id = null): Factory|View
    {
        $name = '';
        $avatar_id = 0;
        if ($player_id !== null) {
            $players = $this->playerRepository->allWhere(['id' => $player_id], ['name', 'avatar_id']);
            if ($players->isNotEmpty()) {
                $name = $players[0]->name;
                $avatar_id = $players[0]->avatar_id;
            }
        }

        return view('settingsProfileNew', ['name' => $name, 'selectedAvatarId' => $avatar_id, 'avatars' => $this->playerRepository->getAvatars()]);
    }

    public function profileSave(Request $request, ?int $player_id = null)
    {
        $user_id = auth()->user()->id;
        $input = $request->only('name', 'avatarId');
        $name = mb_trim($input['name']);
        $avatar_id = (int) $input['avatarId'];
        $players = $this->playerRepository->allWhere(['user_id' => $user_id], ['id', 'name']);
        $name_found = false;
        foreach ($players as $player) {
            if ($player->id !== $player_id && mb_strtolower($player->name) === mb_strtolower($name)) {
                $name_found = true;
            }
        }

        if ($name_found) {
            return back()->withInput()->withErrors(['name' => ['exists']]);
        }

        if ($player_id === null) {
            $entry = ['user_id' => $user_id, 'name' => $name, 'avatar_id' => $avatar_id];
            $player = $this->playerRepository->create($entry);
            $player_id = $player->id;
        } else {
            $entry = ['name' => $name, 'avatar_id' => $avatar_id];
            $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        }

        return to_route('create.controls', [$player_id]);

    }

    public function controlsShow(Request $request, int $player_id): Factory|View
    {
        abort_if($player_id === 0, 403, __('messages.unauthorized_action'));
        $control_mode = 1;
        $control_auto_select = 'Enter';
        $control_manual_select = 'Enter';
        $control_manual_nav = 'Space';
        $help_after_tries = 3;
        $scanning_speed = 2;
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['auto', 'select_key', 'navigate_key', 'help_after_x_mistakes', 'scanning_speed']);
        if ($players->isNotEmpty()) {
            $control_mode = $players[0]->auto;
            $control_select = $players[0]->select_key;
            $control_nav = $players[0]->navigate_key;
            if ($control_mode === 1) {
                $control_auto_select = $control_select;
            } elseif ($control_mode === 2) {
                $control_manual_select = $control_select;
                $control_manual_nav = $control_nav;
            }

            $help_after_tries = $players[0]->help_after_x_mistakes;
            $scanning_speed = $players[0]->scanning_speed;
        }

        return view('settingsControlsNew', ['control_mode' => $control_mode, 'control_auto_select' => $control_auto_select, 'control_manual_select' => $control_manual_select, 'control_manual_nav' => $control_manual_nav, 'help_after_tries' => $help_after_tries, 'scanning_speed' => $scanning_speed]);
    }

    public function controlsSave(Request $request, int $player_id)
    {
        $input = $request->only('controlType', 'controlAutomaticSelectionButton', 'controlManualSelectionButton', 'controlManualNavigationButton', 'helpAfterTries', 'scanningSpeed');
        $control_mode = (int) $input['controlType'];
        $control_auto_select = $input['controlAutomaticSelectionButton'];
        $control_manual_select = $input['controlManualSelectionButton'];
        $control_manual_nav = $input['controlManualNavigationButton'];
        $help_after_tries = (int) $input['helpAfterTries'];
        $scanning_speed = (int) $input['scanningSpeed'];
        $select = $control_auto_select;
        if ($control_mode === 2) {
            $select = $control_manual_select;
        }

        $entry = ['auto' => $control_mode, 'select_key' => $select, 'navigate_key' => $control_manual_nav, 'help_after_x_mistakes' => $help_after_tries, 'scanning_speed' => $scanning_speed];
        $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        $action = $request->only('submit')['submit'];

        if ($action === 'back' || $action === 'profile') {
            return to_route('create.profile', [$player_id]);
        }

        if ($action === 'next' || $action === 'save') {
            return to_route('create.difficulty', [$player_id]);
        }

        abort(403, __('messages.unauthorized_action'));

    }

    public function difficultyShow(Request $request, int $player_id): Factory|View
    {
        abort_if($player_id === 0, 403, __('messages.unauthorized_action'));
        $dice_type = 1;
        $board_size = 2;
        $difficulty = 1;
        $movement_mode = 2;
        $players = $this->playerRepository->allWhere(['id' => $player_id], ['dice_type', 'board_size', 'difficulty', 'movement_mode']);
        if ($players->isNotEmpty()) {
            $dice_type = $players[0]->dice_type;
            $board_size = $players[0]->board_size;
            $difficulty = $players[0]->difficulty;
            $movement_mode = $players[0]->movement_mode;
        }

        return view('settingsDifficultyNew', ['dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode]);
    }

    public function difficultySave(Request $request, int $player_id)
    {
        $input = $request->only('dice', 'gameDuration', 'level', 'movement');
        $dice_type = (int) $input['dice'];
        $board_size = (int) $input['gameDuration'];
        $difficulty = (int) $input['level'];
        $movement_mode = (int) $input['movement'];

        $entry = ['dice_type' => $dice_type, 'board_size' => $board_size, 'difficulty' => $difficulty, 'movement_mode' => $movement_mode];
        $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        $action = $request->only('submit')['submit'];
        if ($action === 'profile') {
            return to_route('create.profile', [$player_id]);
        }

        if ($action === 'back' || $action === 'controls') {
            return to_route('create.controls', [$player_id]);
        }

        if ($action === 'save') {
            return to_route('select.player');
        }

        abort(403, __('messages.unauthorized_action'));

    }
}

<?php

namespace App\Http\Controllers;

use App\BusinessLogicLayer\CustomAudio\CustomAudioManager;
use App\Repository\Player\PlayerRepository;
use Illuminate\Http\Request;

class CustomAudioController extends Controller
{

    protected PlayerRepository $playerRepository;
    protected CustomAudioManager $customAudioManager;

    public function __construct(PlayerRepository $playerRepository, CustomAudioManager $customAudioManager)
    {
        $this->playerRepository = $playerRepository;
        $this->customAudioManager = $customAudioManager;
    }

    /**
     * Show player's audio settings "dummy" function.
     *
     * I am pretty sure that this function returns some values which might be
     * helpful when the back-end is trully implemented.
     */
    public function audioShow(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }

        if ($this->customAudioManager->userExists($player_id)) {

        }

        $player = $this->playerRepository->find($player_id, ['name', 'avatar_id', 'music_volume', 'sound_volume']);
        $name = $player->name;
        $avatar_id = $player->avatar_id;
        $avatarName = $this->playerRepository->getAvatars()[$avatar_id]['asset'];

        $musicVolume = $player->music_volume;
        $soundVolume = $player->sound_volume;

        // playerAudioFiles experimentation.
        $playerAudioFiles = [];
        $playerAudioFiles["sounds_win"] = [
            "sounds.game.win_1" => false,
            "sounds.game.win_2" => false,
            "sounds.game.win_3" => false,
        ];
        $playerAudioFiles["sounds_defeat"] = [
            "sounds.game.defeat_1" => false,
            "sounds.game.defeat_2" => false,
            "sounds.game.defeat_3" => false,
        ];
        $playerAudioFiles["sounds_reward"] = [
            "sounds.game.reward_1" => false,
            "sounds.game.reward_2" => false,
            "sounds.game.reward_3" => false,
        ];
        $playerAudioFiles["sounds_try_again"] = [
            "sounds.game.try_again_1" => true,
            "sounds.game.try_again_2" => false,
            "sounds.game.try_again_3" => false,
        ];

        $playerAudio = $this->getPlayerAudio($player_id, $musicVolume, $soundVolume, $playerAudioFiles);

        \View::share('avatarName', $avatarName);
        \View::share('playerName', $name);
        \View::share('showSettings', true);

        return view(
            'settingsAudio',
            [
                'name' => $name,
                'player_id' => $player_id,
                'playerAudio' => $playerAudio,
            ]
        );
    }

    /**
     * Save player's audio settings "dummy" function.
     *
     * I am pretty sure that this function does not save anything.
     */
    public function audioSave(Request $request, int $player_id, string $back_route, int $game_id)
    {
        if ($player_id == 0) {
            abort(403, __('messages.unauthorized_action'));
        }
        $input = $request->only('musicVolume', 'soundVolume');
        $music_volume = (float) $input['musicVolume'];
        $sound_volume = (float) $input['soundVolume'];
        $this->updateVolumesToDB($player_id, $music_volume, $sound_volume);
        return \Redirect::route('settings', [$player_id, $back_route, $game_id]);
    }

    public function uploadCustomAudioFile(Request $request)
    {
        $player_id = $request->player_id;
        $audio_name = $request->audio_name;
        $audio_path = $request->path;
        $index = $request->index;
        $this->createFolderForPlayerIfRequired($player_id);
        return response(['index' => $index]);
    }

    public function removeCustomAudioFile(Request $request)
    {
        $player_id = $request->player_id;
        $this->createFolderForPlayerIfRequired($player_id);
    }

    public function updateVolumes(Request $request)
    {
        $player_id = $request->player_id;
        $music_volume = $request->has("music_volume") ? $request->music_volume : null;
        $sound_volume = $request->has("sound_volume") ? $request->sound_volume : null;
        $this->updateVolumesToDB($player_id, $music_volume, $sound_volume);
        return response([]);
    }

    protected function updateVolumesToDB(int $player_id, float $music_volume = null, float $sound_volume = null)
    {
        if (!is_null($music_volume) || !is_null($sound_volume)) {
            $entry = ['music_volume' => $music_volume, 'sound_volume' => $sound_volume];
            if (is_null($music_volume))
                $entry = ['sound_volume' => $sound_volume];
            else if (is_null($sound_volume))
                $entry = ['music_volume' => $music_volume];
            $this->playerRepository->updateOrCreate(['id' => $player_id], $entry);
        }
    }

    protected function getPlayerAudio(int $player_id, float $musicVolume, float $soundVolume, $playerAudioFiles)
    {
        $playerAudio = [
            'playerMusicVolume' => $musicVolume,
            'playerSoundVolume' => $soundVolume,
            'updateVolumesUrl' => route('audio.updateVolumes'),
            'playerUrl' => '/player/'.$player_id,
            'playerAudioFiles' => $playerAudioFiles
        ];
        return $playerAudio;
    }

    protected function createFolderForPlayerIfRequired(int $player_id) {
        if (!$this->customAudioManager->userExists($player_id)) {
            $this->customAudioManager->createFolder($player_id);
        }
    }

}

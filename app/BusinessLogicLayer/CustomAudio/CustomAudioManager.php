<?php

namespace App\BusinessLogicLayer\CustomAudio;

use Illuminate\Support\Facades\Storage;

class CustomAudioManager
{

    public function userExists(int $userId): bool
    {
        $file = Storage::disk('local')->get('custom-sounds/'.$userId);
        if ($file == null)
            return false;
        else
            return true;
    }

    public function createFolder(int $userId) {
        Storage::disk('local')->createDirectory('custom-sounds/'.$userId);
    }
}

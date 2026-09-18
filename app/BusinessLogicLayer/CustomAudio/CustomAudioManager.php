<?php

declare(strict_types=1);

namespace App\BusinessLogicLayer\CustomAudio;

use Illuminate\Support\Facades\Storage;

class CustomAudioManager
{
    public function userExists(int $userId): bool
    {
        $file = Storage::disk('local')->get('custom-sounds/' . $userId);
        if ($file === null) {
            return false;
        }

        return true;

    }

    public function createFolder(int $userId): void
    {
        Storage::disk('local')->createDirectory('custom-sounds/' . $userId);
    }
}

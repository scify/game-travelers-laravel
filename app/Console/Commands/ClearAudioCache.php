<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

#[Description('Clears the audios cache')]
#[Signature('audios:clear')]
class ClearAudioCache extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $res = Cache::forget('audioFiles');
        echo 'Clear: ' . $res . "\n\n";

        return $res;
    }
}

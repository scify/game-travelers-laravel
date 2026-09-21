<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

#[Description('Clears the audios cache')]
#[Signature('audios:clear')]
final class ClearAudioCache extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // A false return means the list was not cached, which is not a failure.
        $cleared = Cache::forget('audioFiles');
        $this->info($cleared ? 'Audio file cache cleared.' : 'No audio file cache to clear.');

        return self::SUCCESS;
    }
}

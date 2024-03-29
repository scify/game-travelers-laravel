<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearAudioCache extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audios:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the audios cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int {
        $res = Cache::forget('audioFiles');
        echo "Clear: " . $res . "\n\n";
        return $res;
    }
}

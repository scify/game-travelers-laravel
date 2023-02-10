<!-- resources/views/layout/footer-scripts.blade.php -->
@php
    // @author Pavlos Isaris
    // @link https://raw.githubusercontent.com/scify/Crowdsourcing-Platform/master/resources/views/partials/footer-scripts.blade.php
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\File;
    $currentLocale = app()->getLocale();
    if (!File::exists(base_path('lang/' . $currentLocale))) {
        $currentLocale = "en";
    }
    $langPath = base_path('lang/' . $currentLocale);
    $translations = Cache::rememberForever('translations_' . $currentLocale, function () use ($langPath) {
        return collect(File::allFiles($langPath))->flatMap(function ($file) {
            return [
                $translation = $file->getBasename('.php') => trans($translation),
            ];
        })->toJson();
    });

    // Extremely confusing Default Sounds audioFiles map
    $audioPath = base_path("resources/audio/");
    $audioFiles = Cache::rememberForever('audioFiles', function () use ($audioPath) {
        return collect(File::directories($audioPath))
            ->mapWithKeys(function ($directory) {
                $folderName = basename($directory);
                $subDirectories = collect(File::directories($directory));
                return [
                    $folderName => $subDirectories->count() ? $subDirectories->mapWithKeys(function ($subDirectory) {
                        return [
                            basename($subDirectory) => collect(File::glob($subDirectory . '/*.mp3'))
                                ->mapWithKeys(function ($file) {
                                    return [
                                        (new SplFileInfo($file))->getBasename('.mp3') => basename($file)
                                    ];
                                })
                        ];
                    }) : collect(File::glob($directory . '/*.mp3'))->mapWithKeys(function ($file) {
                        return [
                            (new SplFileInfo($file))->getBasename('.mp3') => basename($file)
                        ];
                    })
                ];
            })->toJson();
    });

    // Test array of custom Sounds playerAudioFiles
    // First we use a randomly generated path based on advanced cryptography :p
    // To be fair we need something less random. Anyway.
    $randomBytes = random_bytes(16); // 16 random bytes * 8 bits = 128 bits
    $hexNumber = bin2hex($randomBytes); // 128 bits / 4 bits per hex digit = 32 hex digits
    $playerUrl = url("/player/$hexNumber"); // random player path which noone can guess

    // According to the mock-ups we need the folllowing:
    // cards_[1-3] (defaults: @todo determine defaults?!, real name: ???)
    // win_[1-3] (defaults: sounds.game.win_[1-8], custom url: playerpath/win_[1-3].mp3)
    // defeat [1-3] (defaults: sounds.game.defeat_[1-3] custom url: playerpath/defeat_[1-3].mp3)
    // reward[1-3] (defaults sounds.game.reward_[1-11] custom url: playerpath/reward_[1-3].mp3)
    // try_again[1-3] (defaults sounds.game.try_again_[1-6] custom url: playerpath/try_again[1-3].mp3)

    // so the hypothetical array should be like this one:

    // So let's say we have this...
    $playerAudioFiles = [
        "sounds" => [
            "game_start" => [
                "welcome_1" => "welcome_1.mp3",  // this was used just for testing.
            ],
            "game" => [
                "defeat_1" => "win_1.mp3",
            ],
        ],
    ];
    // Now compare the above, with what is already in audioFiles:
    $dummyAudioFiles = [
        "fx" => [
            "modal" => "modal.mp3"
        ],
        "sounds" => [
            "game" => [
                "defeat_1" => "defeat_1.mp3",
                "defeat_2" => "defeat_2.mp3",
                "defeat_3" => "defeat_3.mp3",
                "help_1" => "help_1.mp3",
                // and many more...
            ],
        ],
    ];
    // Via JavaScript we can already play a sound like this:
    // window.sound("sounds.game.defeat[1-3]")
    // Then JS plays a random defeat_ sound from the 3 requested / available [1-3]
    // This works already.
    // How can we determine if there is a defeat_ sound in the playerAudioFiles array
    // and if it is, no matter what, to play that sound in playerAudioFiles instead
    // of the one in audioFiles?
    // The answer is on audio.js

@endphp
<script>
    window.Laravel = {{ Js::from([
        'baseUrl' => url("/"),
        'locale' => app()->getLocale(),
        'audioFiles' => json_decode($audioFiles),
        //'playerUrl' => $playerUrl,
        'playerAudioFiles' => $playerAudioFiles,
        'translations' => json_decode($translations)
    ])}}
</script>


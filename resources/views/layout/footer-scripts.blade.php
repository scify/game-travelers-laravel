<!-- resources/views/layout/footer-scripts.blade.php -->
@php
    // Laravel language files (translations) to JSON
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

    // Default Sound files to JSON
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

    //** Player's Custom Sound files to JSON **/

    /* *** $playerAudio[] ***
    // As we need 4 different parameters, let's use an array for all playerAudio settings.
    // As we are using personalised musicVolume & soundVolume for each player,
    // music has been removed from gameSelectPlayer.blade.php. It has also been
    // removed as an option from window.sound (it remains on window.music for legacy, but it gets overriden).

    // Let's see an example of this array (please return false if not set).
    // $playerAudio = [
    //    'playerMusicVolume' => 0.1,
    //    'playerSoundVolume' => 1,
    //    'playerUrl' => '/player/b5b72dd79161d837bef10dd3d54de385', // see concept below
    //    'playerAudioFiles' => [] // see description below
    // ];
    */

    // $playerAudio should be passed to the view. If not, it defaults to false.

    if (!isset($playerAudio)) {
        $playerAudio = false;
    }

    // In general, two things are needed to use custom player sounds. The first
    // one is the URL from which the custom sound files can be accessed. My
    // suggestion is to assign a random path to each player when it is first
    // created. That path should be somehow random, so others can't guess it.
    // The back-end should create that path when the user uploads audio for
    // the very first time. The path should be removed (from storage) when
    // the player deletes themselves.

    /* *** $playerAudio['playerUrl'] ***
    // First we use a randomly generated path based on advanced cryptography :p
    // To be fair we need something less random. Anyway, feel free to concat with an id for debugging.
    // e.g. b5b72dd79161d837bef10dd3d54de385

    $randomBytes = random_bytes(16); // 16 random bytes * 8 bits = 128 bits
    $hexNumber = bin2hex($randomBytes); // 128 bits / 4 bits per hex digit = 32 hex digits
    $playerUrl = url("/player/$hexNumber"); // random player path which noone can guess

    // Therefore the final path is /player/b5b72dd79161d837bef10dd3d54de385
    // The url("") wrapper makes sure that we have an actual Laravel friendly and JSON friendly URL.
    // Note that we don't need a slash at the end of the url.
    // Files uploaded by the Player should be put in there:
    // - Don't create sub-folders, there's no need to do that.
    // - Files should follow the exact same logic as the default sounds e.g.:
    // --- win_[1-3].mp3, defeat_[1-3].mp3 etc.
    // The backend should ensure that
    // a) files are not bigger than i.e. 1MB and they are bigger than (idk?!) 100kb?
    // b) files are actual MP3s (is this possible?! @see https://stackoverflow.com/questions/2006632/how-can-i-check-if-a-file-is-mp3-or-image-file not sure though - untested.
    */

    // $playerAudio['playerUrl'] should be passed to the View. If not, it defaults to false.
    if (!isset($playerAudio["playerUrl"])) {
        $playerAudio["playerUrl"] = false;
    }

    /* *** $playerAudio["playerAudioFiles"][] ***
    // According to the mock-ups we need the folllowing:
    // cards_[1-3] SKIP THEM FOR NOW.
    // win_[1-3] (default: sounds.game.win_[1-8], custom url: $playerAudio["playerUrl"]/win_[1-3].mp3)
    // defeat [1-3] (default: sounds.game.defeat_[1-3] custom url: $playerAudio["playerUrl"]/defeat_[1-3].mp3)
    // reward[1-3] (default: sounds.game.reward_[1-11] custom url: $playerAudio["playerUrl"]/reward_[1-3].mp3)
    // try_again[1-3] (default: sounds.game.try_again_[1-6] custom url: $playerAudio["playerUrl"]/try_again[1-3].mp3)

    // The front-end expects an array like this:
    $playerAudio["playerAudioFiles"] = [
        "sounds" => [
            "game" => [
                "defeat_2" => "defeat_2.mp3", // JS only cares about key. The value is ignored, but should be passed.
                "defeat_3" => "defeat_3.mp3", // Don't send keys for non-existent custom files - don't set them to false or null, just don't create them.
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
    // So, let's say that user has uploaded defeat_2 and defeat_3.
    // They are saved at player/defeat_2.mp3 and player/defeat_3.mp3
    // Database for the player has a sounds.game.defeat_2 and a sounds.game.defeat_3 which are set to TRUE.

    // The $playerAudio["playerAudioFiles"] array though should just contain the
    // TRUE key names (the value should be there, but it doesn't do anything).
    // Now, when exporting the "TRUE" values for all keys starting with "sounds",
    // you create an array sounds.game_defeat_2 field is converted to sounds[game[defeat_2]] ...
    // In short, we are creating an array identical to the automatically created
    // $audioFiles, which only have the keys for sounds that the user has uploaded.
    // Easy, isn't it?! If not, we can easily adjust PHP to specifications view
    // the player controller or something, just like we did for $switcher.

    // Everything else is handled by JS on audio.js.
    // We don't change anything in the existing code.
    */

    // $playerAudio["playerAudioFiles"][] should be passed to the View.
    // If not, or if it's not an array, it defaults to false.
    if (!isset($playerAudio["playerAudioFiles"])) {
        $playerAudio["playerAudioFiles"] = false;
    } else {
        if (!is_array($playerAudio["playerAudioFiles"])) {
            $playerAudio["playerAudioFiles"] = false;
        }
    }

    // Via JavaScript we can already play a sound like this:
    // window.sound("sounds.game.defeat[1-3]")
    // Then JS plays a random defeat_ sound from the 3 requested / available [1-3]
    // This works already.
    // How can we determine if there is a defeat_ sound in the playerAudioFiles array
    // and if it is, no matter what, to play that sound in playerAudioFiles instead
    // of the one in audioFiles?
    // The answer is on audio.js... Let's move on to the easy variables.

    // Player can set Sound and Music Volume.
    // These should be passed wherever there is sound or music including the menus.
    // JavaScript will use those as well from now on. If nothing is set, then
    // playerMusicVolume defaults to 0.2 and playerSoundVolume defaults to 1.
    if (!isset($playerAudio["playerMusicVolume"])) {
        $playerAudio["playerMusicVolume"] = 0.2;
    } else {
        if (!$playerAudio["playerMusicVolume"]) {
            $playerAudio["playerMusicVolume"] = 0.2;
        }
    }
    if (!isset($playerAudio["playerSoundVolume"])) {
        $playerAudio["playerSoundVolume"] = 1;

    } else {
        if (!$playerAudio["playerSoundVolume"]) {
            $playerAudio["playerSoundVolume"] = 1;
        }
    }

@endphp
<script>
    window.Laravel = {{ Js::from([
        'baseUrl' => url("/"),
        'locale' => app()->getLocale(),
        'translations' => json_decode($translations),
        'audioFiles' => json_decode($audioFiles),
        'playerAudio' => $playerAudio,
])}}
</script>


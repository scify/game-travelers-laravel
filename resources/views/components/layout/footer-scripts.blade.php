<!-- resources/views/layout/components/footer-scripts.blade.php -->
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
    // Let's see an example of this array (please return false if not set).
    // $playerAudio = [
    //    'playerMusicVolume' => 0.1,
    //    'playerSoundVolume' => 1,
    //    'playerUrl' => '/player/b5b72dd79161d837bef10dd3d54de385', // see concept below
    //    'updateVolumesUrl' => 'http://127.0.0.1:8001/audio/updateVolumes'
    //    'playerAudioFiles' => [] // see description below
    // ];
    //
    // $playerAudio should be passed as a parameter to <x-layout>. If not, it
    // defaults to an empty array with some default parameters (see below).
    // For a more detailed documentation see the example below:
    // @see docs/examples/examplePlayerAudio.php
    //
    */
    if ( (!isset($playerAudio)) || ($playerAudio == false) ) {
        $playerAudio = [];
    }

    // Default parameters for Music Volume:
    if (!isset($playerAudio["playerMusicVolume"])) {
        $playerAudio["playerMusicVolume"] = 0.2;
    } else {
        if ($playerAudio["playerMusicVolume"] === 0 || $playerAudio["playerMusicVolume"] === "0") {
            // do nothing, keep the current value of $playerAudio["playerMusicVolume"]
        } else {
            $playerAudio["playerMusicVolume"] = (float) $playerAudio["playerMusicVolume"];
        }
    }
    // Default parameters for Sound Volume:
    if (!isset($playerAudio["playerSoundVolume"])) {
        $playerAudio["playerSoundVolume"] = 1;
    } else {
        if ($playerAudio["playerSoundVolume"] === 0 || $playerAudio["playerSoundVolume"] === "0") {
            // do nothing, keep the current value of $playerAudio["playerMusicVolume"]
        } else {
            $playerAudio["playerSoundVolume"] = (float) $playerAudio["playerSoundVolume"];
        }
    }
    // $playerAudio['playerUrl'] should be passed to the View. If not, it defaults to false.
    if (!isset($playerAudio["playerUrl"])) {
        $playerAudio["playerUrl"] = false;
    }
    // $playerAudio['updateVolumesUrl'] should be passed to the View. If not it defaults to false.
    if (!isset($playerAudio["updateVolumesUrl"])) {
        $playerAudio["updateVolumesUrl"] = false;
    }
    // $playerAudio["playerAudioFiles"][] should be passed to the View.
    // If not, or if it's not an array, it defaults to false.
    if (!isset($playerAudio["playerAudioFiles"])) {
        $playerAudio["playerAudioFiles"] = false;
    } else {
        if (!is_array($playerAudio["playerAudioFiles"])) {
            $playerAudio["playerAudioFiles"] = false;
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


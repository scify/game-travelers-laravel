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

    // Extremely confusing audioFiles map
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

@endphp
<script>
    window.Laravel = {{ Js::from([
        'baseUrl' => url("/"),
        'locale' => app()->getLocale(),
        'audioFiles' => json_decode($audioFiles),
        'translations' => json_decode($translations)
    ])}}
</script>


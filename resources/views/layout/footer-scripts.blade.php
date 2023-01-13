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
@endphp
<script>
    window.Laravel = {{ Js::from([
        'baseUrl' => url("/"),
        'locale' => app()->getLocale(),
        'translations' => json_decode($translations)
    ])}}
</script>

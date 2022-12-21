{{--*
    * Blank layout (no header/footer) for Taxidiotes.
    *
    * Same as the default layout.blade.php but with no footer or header. Used
    * on the splash screen and might be used on the board as well. See the
    * default layout for optional parameters.
    --}}
<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Ταξιδιώτες, ένα παιχνίδι από την SciFY' }}">
    <meta name="keywords" content="{{-- @todo: keywords --}}">
    <title>{{ $title ?? 'Ταξιδιώτες' }}</title>
    <link rel="icon" href="{{ asset('images/favicons/favicon-32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('images/favicons/favicon-128.png') }}" sizes="128x128">
    <link rel="icon" href="{{ asset('images/favicons/favicon-192.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('images/favicons/favicon-180.png') }}" sizes="180x180">
    <link rel="canonical" href="{{ url()->current() }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    @isset($hasVue)<script src="{{ mix('js/vue.js') }}" defer></script>@endisset
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css') {{-- Optional: Additional CSS stylesheets, if needed. --}}
</head>
<body>
    <div class="travelers">
        <div class="travelers-container">
            <section class="content">
                {{ $slot }}
            </section>
        </div>
    </div>
    @yield('scripts', '') {{-- Optional: JS scripts loaded after DOM is rendered --}}
</body>
</html>

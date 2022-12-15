<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Ταξιδιώτες, ένα παιχνίδι από την SciFY' }}">
    <title>{{ $title ?? 'Ταξιδιώτες' }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script src="{{ mix('js/main.js') }}" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="travelers">
        <div class="content">

            {{ $slot }}

        </div>
    </div>
    @yield('scripts', '') {{-- '' = default if no scripts --}}

</body>
</html>

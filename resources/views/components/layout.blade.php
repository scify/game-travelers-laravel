<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Ταξιδιώτες, ένα παιχνίδι από την SciFY.' }}">
    <meta name="keywords" content="">
    <title>{{ $title ?? 'Ταξιδιώτες' }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <script src="{{ mix('js/main.js') }}" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="travelers">
        <div class="content">

            @include('layout.header')

            {{ $slot }}

            @include('layout.footer')

        </div>
    </div>
    @yield('scripts', '') {{-- '' = default if no scripts --}}

</body>
</html>

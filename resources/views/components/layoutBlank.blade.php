{{--*
    * Blank layout (no header/footer) for Taxidiotes (Splash screens).
    *
    * Same as the default game layout.blade.php but with no footer or header.
    * Used on the splash screen and might be used on the board as well. See the
    * default layout.blade.php for supported optional parameters.
    --}}
<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('layout.meta')
    @include('layout.favicons')
    <link rel="canonical" href="{{ url()->current() }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css', '') {{-- Optional: Additional CSS stylesheets, if needed. --}}
</head>
<body>
    <div class="travelers">
        <div class="travelers-container">
            <section class="content">
                {{ $slot }}
            </section>
        </div>
    </div>
    @include('layout.footer-scripts')
    @yield('scripts', '') {{-- Optional: JS scripts loaded after DOM is rendered --}}
    @isset($hasVue)<script src="{{ mix('js/vue.js') }}" defer></script>@endisset
    @include ("layout.analytics")
</body>
</html>

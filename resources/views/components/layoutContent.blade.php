{{--*
    * Landing aka Content layout for Taxidiotes (the site, i.e. *NOT* the game).
    *
    * Same as the default game layout.blade.php but overflow-y (aka vertical
    * scrolling) is expected and therefore, there are no attempts via CSS to
    * force the content to be rendered in the absolute middle of the viewport.
    * Used on all content pages: e.g. Landing (aka Index), Privacy Policy,
    * Cookies etc. See the default layout.blade.php for optional parameters.
    * Note that this layout does not support and does not include Vue.js or
    * all the custom-made global window.Laravel JS dependencies.
    --}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layout.meta')
    @include('layout.favicons')
    <link rel="canonical" href="{{ url()->current() }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css', '') {{-- Optional: Additional CSS stylesheets, if needed. --}}
</head>
<body>
    @include('layout.landing.header')
    <section class="content-non-interactive mb-n2">
        {{ $slot }}
    </section>
    @include('layout.landing.footer')
    @yield('scripts', '') {{-- Optional: JS scripts loaded after DOM is rendered --}}
</body>
</html>
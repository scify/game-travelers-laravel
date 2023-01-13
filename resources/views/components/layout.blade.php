{{--*
    * Default layout for Taxidiotes.
    *
    * Almost all the pages on the site use this layout. It set ups the default
    * HTML structure and loads both Bootstrap (via app.js) and processed SASS
    * (via app.css) . There is one slot for every page's content ($slot) plus
    * two minor slots for additional JavaScript and CSS code (via yields). Minor
    * slots are of course optional. This template also @includes the site's
    * header and footer which reside in the /views/layout folder for easier
    * customisation.
    *
    * Usage example on a Blade template:
    *  <x-layout :title="'Ρυθμίσεις παίκτη | Ταξιδιώτες'">
    *    HTML Page Content
    *  </x-layout>
    *
    *
    * Optional parameters:
    * <string> $title (default: Ταξιδιώτες) - The title of the page.
    * <string> $description (default: Ταξιδιώτες, ένα παιχνίδι από την SciFY)
    * <true|null> $hasUserMenu (default: null) - If true, the User/Player menu
    *    is added on the top right corner of the header of the page.
    * <true|null> $hasVue (default: null) - If true vue.js dependency is loaded.
    * <string (class name)|null> $background - A custom "decoration" class for
    *    adding a background into the header. This is purely a front-end thing
    *    and is already set properly wherever is needed.
    --}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Ταξιδιώτες, ένα παιχνίδι από την SciFY.' }}">
    <meta name="keywords" content="{{-- @todo: keywords --}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Ταξιδιώτες' }}</title>
    @include('layout.favicons')
    <link rel="canonical" href="{{ url()->current() }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    @isset($hasVue)<script src="{{ mix('js/vue.js') }}" defer></script>@endisset
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css', '') {{-- Optional: Additional CSS stylesheets, if needed. --}}
</head>
<body>
    <div class="travelers">
        <div class="travelers-container">
            @include('layout.header')
            <section class="content">
                {{ $slot }}
            </section>
            @include('layout.footer')
        </div>
    </div>
    @include('layout.footer-scripts')
    @yield('scripts', '') {{-- Optional: JS scripts loaded after DOM is rendered --}}
</body>
</html>

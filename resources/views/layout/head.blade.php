<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ $description ?? 'Ταξιδιώτες, ένα παιχνίδι από την SciFY' }}">
<title>@yield('title') | Ταξιδιώτες</title>
<!-- Icons -->
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="16x16">
<link rel="icon" href="{{ asset('images/favicons/favicon-32.png') }}" sizes="32x32">
{{-- @TODO: Favicons @see https://www.emergeinteractive.com/insights/detail/the-essentials-of-favicons/ --}}
<!-- Scripts -->
<script src="{{ mix('js/main.js') }}" defer></script>
<!-- Styles -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

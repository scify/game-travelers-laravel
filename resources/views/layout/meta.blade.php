<meta charset="utf-8">
<meta name="application-name" content="{{ __('messages.app_name') }}">
<meta name="author" content="SciFY">
<meta name="description" content="{{ $description ?? __('messages.meta_description') }}">
<meta name="keywords" content="{{ __('messages.meta_keywords') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title ?? __('messages.app_name') }}</title>
<meta name="og:title" property="og:title" content="{{ $title ?? __('messages.app_name') }}">
<meta name="og:type" property="og:type" content="website">
<meta name="og:url" property="og:url" content="{{ url()->current() }}">
<meta name="og:image" property="og:image" content="{{ asset('images/taxidiotes_logo.webp') }}">
<meta name="og:description" property="og:description" content="{{ __('messages.meta_description') }}">
<meta name="og:site_name" property="og:site_name" content="{{ __('messages.app_name') }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $title ?? __('messages.app_name') }}">
<meta name="twitter:description" content="{{ __('messages.meta_description') }}">
<meta name="twitter:image" content="{{ asset('images/taxidiotes_logo.webp') }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">

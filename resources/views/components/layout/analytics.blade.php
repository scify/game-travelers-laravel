<!-- resources/views/layout/components/layout/analytics.blade.php -->
<x-laravel-cookies-consent />
<!-- Check the 'targeting' cookie: -->
@if(isset($_COOKIE[config('cookies_consent.cookie_prefix') . 'cookies_consent']))
    @php
        $cookiesConsent = json_decode($_COOKIE[config('cookies_consent.cookie_prefix') . 'cookies_consent'], true);
    @endphp
    @if(isset($cookiesConsent['targeting']) && $cookiesConsent['targeting'] && config('app.google_analytics_id'))
        <!-- Google tag (gtag.js) -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_analytics_id') }}"></script>
        <script>
					window.dataLayer = window.dataLayer || [];

					function gtag() {
						dataLayer.push(arguments);
					}

					gtag("js", new Date());

					gtag("config", '{{ config('app.google_analytics_id') }}', { "anonymize_ip": true });
        </script>
    @endif
@endif

<?php

declare(strict_types=1);

use App\Support\CookieNames;

$appName = (string) env('APP_NAME', 'laravel');
$cookiePrefix = CookieNames::consentPrefix($appName);

return [
    /*
     * Prefix of the consent cookie. The package appends `cookies_consent` to it without a
     * separator, so the prefix ends with an underscore. It is derived from the application
     * name: "My App" gives `my_app_` and the cookie `my_app_cookies_consent`.
     * The cookie stores one boolean per category:
     *
     * {
     *    "strictly_necessary": true,
     *    "analytics": false
     * }
     */
    'cookie_prefix' => $cookiePrefix,
    'display_floating_button' => true, // Set to false to display the footer link instead
    'hide_floating_button_on_mobile' => false, // Set to true to hide the floating button on mobile
    'use_separate_page' => true, // Set to true to use a separate page for cookies explanation
    'categories_collapsed_by_default' => true, // Set to false to initially collapse the optional categories
    'cookie_policy_page_custom_url' => '/cookies-policy', // Set to a custom URL for the cookie policy page
    'use_floating_modal' => false, // Set to true to disable the use of showModal() on the dialog HTML element
    /*
    |--------------------------------------------------------------------------
    | Editor
    |--------------------------------------------------------------------------
    |
    | Choose your preferred cookies to be shown. You can add more cookies as desired.
    | If, for example you add another cookie with the name "marketing", then you should also
    | publish the translation files and add a "cookie_marketing" key in the translation file,
    | since the plugin will try to display the cookie name by this convention.
    | The `name` of each cookie is also used to erase it when the visitor rejects its category,
    | so list the real cookie names.
    |
    | Built-in: "strictly_necessary"
    |
    */
    'cookies' => [
        'strictly_necessary' => [
            [
                'name' => $cookiePrefix . 'cookies_consent',
                'description' => 'cookies_consent::messages.cookie_cookies_consent_description',
                'duration' => 'cookies_consent::messages.years',
                'duration_count' => 1,
                'policy_external_link' => null,
            ],
            [
                'name' => 'XSRF-TOKEN',
                'description' => 'cookies_consent::messages.cookie_xsrf_token_description',
                'duration' => 'cookies_consent::messages.hours',
                'duration_count' => 2,
                'policy_external_link' => null,
            ],
            [
                // Derived exactly as config/session.php derives it; the test suite keeps the two in step.
                'name' => CookieNames::laravelSession(env('SESSION_COOKIE'), $appName),
                'description' => 'cookies_consent::messages.cookie_laravel_session_description',
                'duration' => 'cookies_consent::messages.hours',
                'duration_count' => 2,
                'policy_external_link' => null,
            ],
        ],
        'analytics' => [
            // GA4 cookie usage on websites:
            // @link https://support.google.com/analytics/answer/11397207
            [
                'name' => '_ga',
                'description' => 'cookies.google_analytics._ga_description',
                'duration' => 'cookies_consent::messages.years',
                'duration_count' => 2,
                'policy_external_link' => 'https://policies.google.com/privacy',
            ],
            [
                'name' => CookieNames::gaSession(env('GOOGLE_ANALYTICS_ID')),
                'description' => 'cookies.google_analytics._ga_container_description',
                'duration' => 'cookies_consent::messages.years',
                'duration_count' => 2,
                'policy_external_link' => 'https://policies.google.com/privacy',
            ],
        ],
    ],
    'required' => ['strictly_necessary'],
    /*
     * Lifetime, in days, of the `{cookie_prefix}cookies_consent` cookie that stores the visitor's choices.
     * Default is 365 days. Set it to 0 to keep the consent for the browser session only.
     * If you change it, also update the `duration` / `duration_count` declared for that cookie
     * under `strictly_necessary` above, so that the banner tells the visitor the truth.
     */
    'cookie_lifetime' => 365,
];

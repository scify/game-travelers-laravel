<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Cookie names derived from one source, so the cookie policy matches what is set.
 *
 * Called from config files, which load before facades and providers: every
 * method stays pure, free of env(), config() and the container.
 */
final readonly class CookieNames {
    private function __construct() {}

    /**
     * Consent cookie prefix; the package appends `cookies_consent` to it without a separator.
     */
    public static function consentPrefix(string $appName): string {
        return Str::slug($appName, '_') . '_';
    }

    /**
     * Session cookie name in Laravel 9's shape, `my_app_session`, so an upgraded installation keeps its cookie.
     * Shared by config/session.php and the cookie policy.
     */
    public static function laravelSession(?string $configuredName, string $appName): string {
        return $configuredName ?? Str::slug($appName, '_') . '_session';
    }

    /**
     * GA4 names its session cookie after the measurement ID, without the "G-".
     *
     * An ID outside that shape yields the placeholder, which names no real cookie.
     */
    public static function gaSession(?string $measurementId): string {
        $id = (string) $measurementId;

        return Str::isMatch('/^G-[A-Z0-9]+$/', $id)
            ? '_ga_' . Str::chopStart($id, 'G-')
            : '_ga_<container-id>';
    }
}

<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Contracts\Foundation\Application;

/**
 * One answer to "are the debug tools on", read by the route guard and the views.
 *
 * On only in a local installation with APP_DEBUG set. Elsewhere the state route
 * answers 404 and the board renders no debug strip.
 */
final readonly class DebugMode
{
    private function __construct() {}

    public static function enabled(Application $app): bool
    {
        return $app->environment('local') && $app->hasDebugModeEnabled();
    }
}

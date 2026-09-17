<?php

declare(strict_types=1);

namespace App\Support\Dev;

/**
 * DDEV detection for local development tooling.
 *
 * DDEV exports IS_DDEV_PROJECT inside its containers, so it is read with getenv()
 * rather than env(): it exists whatever .env says and it survives config caching.
 */
final readonly class Ddev
{
    private function __construct() {}

    public static function isActive(): bool
    {
        return getenv('IS_DDEV_PROJECT') === 'true';
    }
}

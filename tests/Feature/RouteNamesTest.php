<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * Every route name belongs to one route, or the routes cannot be cached.
 *
 * A page and its form share a URI and carry two names, `x` and `x.save`.
 * A repeated name works at runtime, where the last route wins; `route:cache`
 * rejects it.
 */
class RouteNamesTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[Test]
    public function route_names_are_unique(): void
    {
        $names = array_filter(array_map(
            static fn (RoutingRoute $route): ?string => $route->getName(),
            Route::getRoutes()->getRoutes(),
        ));

        $repeated = array_keys(array_filter(array_count_values($names), static fn (int $count): bool => $count > 1));

        $this->assertSame([], $repeated);
    }
}

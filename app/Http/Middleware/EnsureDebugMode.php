<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\DebugMode;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Hides the debug routes wherever DebugMode is off, as if they did not exist.
 */
final readonly class EnsureDebugMode
{
    public function __construct(private Application $app) {}

    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless(DebugMode::enabled($this->app), 404);

        return $next($request);
    }
}

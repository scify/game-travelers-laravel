<?php

declare(strict_types=1);

namespace App\Providers;

use App\BusinessLogicLayer\User\UserRole\UserRoleManager;
use App\Support\Dev\Ddev;
use Illuminate\Foundation\DevCommands;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Boost\Mcp\ToolExecutor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path logged-in users are sent to after login and registration,
     * and when they open a guest-only page.
     */
    public const string HOME = '/home';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindBoost();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UserRoleManager $userRoleManager): void
    {
        $this->configureCommands();
        $this->configureGates($userRoleManager);
    }

    /**
     * Let Boost's MCP server reach PHP inside a DDEV container.
     *
     * A developer on DDEV sets boost.executable_paths.php to "ddev", so the
     * generated agent files and the MCP command run through DDEV from the host.
     * The MCP server itself already runs inside the container, where "ddev" does
     * not exist, so its tool executor falls back to Boost's PHP_BINARY default.
     * Boost is a development dependency; without it the method returns early.
     */
    private function bindBoost(): void
    {
        if (! Ddev::isActive() || ! class_exists(ToolExecutor::class)) {
            return;
        }

        $this->app->bind(static function (): ToolExecutor {
            config(['boost.executable_paths.php' => null]);

            return new ToolExecutor();
        });
    }

    /**
     * Configure the application's commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction(),
        );

        // Plain interleaved output in the terminal's own buffer:
        DevCommands::inline();
        DevCommands::except('queue', ...(Ddev::isActive() ? ['server'] : []));
        // @link https://github.com/laravel/multiplex/issues/24
        DevCommands::register('exec node_modules/.bin/vite', 'vite');
    }

    /**
     * Register the gates the user roles grant.
     */
    private function configureGates(UserRoleManager $userRoleManager): void
    {
        $userRoleManager->registerUserPolicies();
    }
}

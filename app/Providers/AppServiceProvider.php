<?php

namespace App\Providers;

use App\BusinessLogicLayer\User\UserRole\UserRoleManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * The path logged-in users are sent to after login and registration,
     * and when they open a guest-only page.
     */
    public const HOME = '/home';

    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        $this->app->make(UserRoleManager::class)->registerUserPolicies();
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Application service provider used to register any application services
 * and bind classes into the service container. Global view composers
 * for menus, footer and settings will be registered here in later phases.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // You can bind additional services or repositories here.
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bootstrapping logic such as sharing data with views can go here.
    }
}
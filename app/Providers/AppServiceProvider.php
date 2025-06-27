<?php

namespace App\Providers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('roles', function (array $roles) {
            return auth()->check() && in_array(auth()->user()->role, $roles, true);
        });

        Blade::if('isguest', function () {
            return !auth()->check();
        });

    }
}

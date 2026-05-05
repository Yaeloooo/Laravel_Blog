<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
    // Si la URL contiene 'ngrok', forzamos HTTPS
    if (str_contains(request()->getHttpHost(), 'ngrok-free.dev')) {
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
}

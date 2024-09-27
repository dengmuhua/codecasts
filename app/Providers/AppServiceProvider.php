<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CodeServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->instance('code', new CodeServices);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

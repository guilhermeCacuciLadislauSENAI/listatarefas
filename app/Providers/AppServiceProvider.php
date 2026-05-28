<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Força a substituição das variáveis do Render que estão vindo erradas
        putenv('DB_DATABASE=tasknow');
        putenv('DB_USERNAME=tasknow');
        putenv('DB_PASSWORD=kz8VPsV22yP7NHd0xAkD2841WLV3d1mf');
        putenv('DB_HOST=dpg-d8c2f89kh4rs738gugi0-a.ohio-postgres.render.com');
        putenv('DB_PORT=5432');
        putenv('DB_SSLMODE=require');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
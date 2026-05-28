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
        //
    }

    /**
     * Bootstrap any application services.
     */
  public function boot(): void
{
    if (env('APP_ENV') === 'production') {
        \Illuminate\Support\Facades\URL::forceScheme('https');
        
        // Garante a migração automática das tabelas para o banco 'tasknow'
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $e) {
            // Evita que o app quebre se o banco estiver ocupado
        }
    }
}
}

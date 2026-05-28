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
    // Configurações exclusivas para o ambiente online (produção)
    if (env('APP_ENV') === 'production') {
        // Força todos os links, CSS e Bootstrap a usarem HTTPS (evita tela quebrada)
        \Illuminate\Support\Facades\URL::forceScheme('https');
        
        // Truque de ouro: Executa as Migrations automaticamente sempre que o Render iniciar o app
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $e) {
            // Silencia o erro caso o banco ainda esteja inicializando
        }
    }
}
}

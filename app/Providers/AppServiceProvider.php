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
        // Esto crea un alias global 'Mpdf' para que lo uses donde quieras
        if (class_exists(\Mpdf\Mpdf::class)) {
            class_alias(\Mpdf\Mpdf::class, 'Mpdf');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

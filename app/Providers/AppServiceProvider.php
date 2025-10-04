<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


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
   // Permiso para panel de empleado (admin y empleado)
    Gate::define('view-empleado-panel', function ($user) {
        return in_array($user->role, ['admin', 'empleado']);
    });

    // Permiso para panel de cliente (admin y cliente)
    Gate::define('view-cliente-panel', function ($user) {
        return in_array($user->role, ['admin', 'cliente']);
    });
}
}

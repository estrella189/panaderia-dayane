<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        Gate::define('admin', fn (User $user) => $user->role === 'admin');
        Gate::define('empleado', fn (User $user) => $user->role === 'empleado');
        Gate::define('cliente', fn (User $user) => $user->role === 'cliente');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 🔹 Helpers de roles
    public function isAdmin(): bool     { return $this->role === 'admin'; }
    public function isEmpleado(): bool  { return $this->role === 'empleado'; }
    public function isCliente(): bool   { return $this->role === 'cliente'; }

    // 🔹 Relaciones con otras tablas

    // Un cliente puede tener muchas cotizaciones
    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'id_cliente');
    }

    // Un cliente puede tener muchos pedidos
    public function pedidos()
    {
        return $this->hasMany(pedido::class, 'id_cliente');
    }

    // Un admin  puede responder cotizaciones
    public function respuestasCotizacion()
    {
        return $this->hasMany(RespuestaCotizacion::class, 'admin_id');
    }
}

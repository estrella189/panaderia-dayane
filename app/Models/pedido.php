<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['user_id','fecha_entrega','notas','estado','total'];

    public function items()
    {
        return $this->hasMany(Pedidoitem::class);
    }
}

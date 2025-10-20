<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidoitem extends Model
{
    protected $fillable = ['pedido_id','producto_id','cantidad','precio_unit','personalizacion'];
    protected $casts = ['personalizacion' => 'array'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
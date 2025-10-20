<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidoitem extends Model
{
    protected $table = 'pedido_items';

    protected $fillable = [
        'pedido_id','producto_id','cantidad','tamanio','sabor',
        'precio_unitario','subtotal',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'user_id', 'fecha_entrega', 'notas', 'estado', 'total',
    ];

    protected $casts = [
        'fecha_entrega' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PedidoItem::class, 'pedido_id');
    }
}

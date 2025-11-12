<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'id_cliente',
        'id_producto',
        'detalles',
        'precio',
        'estado', // pendiente | cotizado
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }
   public function producto()
    {
        // FK: cotizaciones.id_producto -> productos.id
        return $this->belongsTo(\App\Models\Producto::class, 'id_producto', 'id')
            ->withDefault(); // evita null si no encuentra (seguirá 'no asignado')
    }
    public function respuesta()
{
    return $this->hasOne(\App\Models\RespuestaCotizacion::class, 'cotizacion_id');
}
public function pedido()
{
    return $this->hasOne(\App\Models\Pedido::class, 'id_cotizacion');
}


}

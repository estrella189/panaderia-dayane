<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespuestaCotizacion extends Model
{
    // Tu tabla es singular, así que indícalo:
    protected $table = 'respuesta_cotizacion';

    protected $fillable = [
        'cotizacion_id',
        'admin_id',
        'precio_total',
        'mensaje_admin',
        'fecha_respuesta',
    ];

    protected $casts = [
        'fecha_respuesta' => 'datetime',
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    
}

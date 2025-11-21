<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cliente',
        'id_cotizacion',
        'estado',
        // agrega los demás campos que tengas
    ];

    // Relación con users
    public function empleado()
{
    return $this->belongsTo(User::class, 'id_empleado');
}

    public function cliente()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_cliente', 'id')
            ->withDefault(['name' => '—']);
    }

    public function cotizacion()
{
    return $this->belongsTo(\App\Models\Cotizacion::class, 'id_cotizacion', 'id')
        ->withDefault(['detalles' => '—']); // 👈 usa detalles
}

}

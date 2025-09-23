<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class productos extends Model
{

    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'IdProducto';
    public $timestamps = true;

    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Precio',
        'Stock',
        'IdCategoria',
    ];

    public function categoria()
    {
        return $this->belongsTo(categorias::class, 'IdCategoria', 'IdCategoria');
    }
}



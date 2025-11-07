<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categoria',
        'id_subcategoria',
        'nombre',
        'descripcion',
        'imagen',
    ];

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    // Relación con Subcategoría
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'id_subcategoria');
    }
}

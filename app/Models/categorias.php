<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class categorias extends Model
{
    
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'IdCategoria';
    public $timestamps = true;

    protected $fillable = [
        'NombreCategoria',
    ];

    public function productos()
    {
        return $this->hasMany(productos::class, 'IdCategoria', 'IdCategoria');
    }
}


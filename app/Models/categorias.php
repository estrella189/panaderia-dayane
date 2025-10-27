<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['nombre','slug','parent_id'];

    public function parent() {
        return $this->belongsTo(categorias::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(categorias::class, 'parent_id');
    }

    public function productos() {
        return $this->hasMany(Productos::class, 'categoria_id');
    }
}


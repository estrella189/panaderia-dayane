<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\categorias;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Grupos (padres)
        $grupos = [
            'Repostería'     => ['Pan Dulce', 'Pan Salado', 'Pay de queso'],
            'Pasteles'       => ['Rollos y Variedades', 'Productos temporada', 'Pasteles de chocolate', 'Para Eventos', 'Pasteles de fruta'],
            'Otros Productos'=> ['Leche', 'Coca-Cola y Refrescos', 'Hidratantes'],
        ];

        foreach ($grupos as $padreNombre => $hijos) {
            $padre = categorias::firstOrCreate(
                ['slug' => Str::slug($padreNombre)],
                ['nombre' => $padreNombre, 'parent_id' => null]
            );

            foreach ($hijos as $hijoNombre) {
                categorias::firstOrCreate(
                    ['slug' => Str::slug($hijoNombre)],
                    ['nombre' => $hijoNombre, 'parent_id' => $padre->id]
                );
            }
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Subcategoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Categorías principales y sus subcategorías
        $grupos = [
            'Repostería' => ['Pan Dulce', 'Pan Salado', 'Pay de Queso'],
            'Pasteles' => ['Rollos y Variedades', 'Productos de Temporada', 'Pasteles de Chocolate', 'Para Eventos', 'Pasteles de Fruta'],
            'Otros Productos' => ['Leche', 'Refrescos', 'Hidratantes'],
        ];

        foreach ($grupos as $nombreCategoria => $subcategorias) {
            // Crear la categoría principal
            $categoria = Categoria::firstOrCreate(['nombre' => $nombreCategoria]);

            // Crear sus subcategorías
            foreach ($subcategorias as $nombreSubcategoria) {
                Subcategoria::firstOrCreate([
                    'nombre' => $nombreSubcategoria,
                    'id_categoria' => $categoria->id,
                ]);
            }
        }
    }
}

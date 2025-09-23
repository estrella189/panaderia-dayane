<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class PanaderiaDB extends Controller
{
    private $texto = "";

    // Método para recuperar e insertar datos
    public function recuperarBD()
    {
        $this->crearCategorias();
        $this->crearProductos();
        return $this->texto;
    }
    

    public function crearCategorias()
    {
        $ruta = storage_path('app/categorias.json');
        $json = file_get_contents($ruta);
        $categorias = json_decode($json, true)['categoria'];
    
        foreach ($categorias as $categoria) {
            try {
                // Verificar si la categoría ya existe
                $existe = DB::table('categorias')
                            ->where('NombreCategoria', $categoria['NombreCategoria'])
                            ->exists();
    
                if (!$existe) {
                    DB::table('categorias')->insert([
                        'NombreCategoria' => $categoria['NombreCategoria'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    
                    ]);
                    $this->texto .= "Categoría '{$categoria['NombreCategoria']}' creada correctamente. <br>";
                } else {
                    $this->texto .= "La categoría '{$categoria['NombreCategoria']}' ya existe. <br>";
                }
            } catch (\Exception $e) {
                $this->texto .= "Error al crear la categoría '{$categoria['NombreCategoria']}': {$e->getMessage()}<br>";
            }
        }
    }
    
    public function crearProductos()
    {
        $ruta = storage_path('app/productos.json');
        $json = file_get_contents($ruta);
        $productos = json_decode($json, true)['productos'];
    
        foreach ($productos as $producto) {
            try {
                // Verificar si el IdCategoria existe en la base de datos
                $categoriaExiste = DB::table('categorias')
                                    ->where('IdCategoria', $producto['IdCategoria'])
                                    ->exists();
    
                if ($categoriaExiste) {
                    DB::table('productos')->insert([
                        'Nombre' => $producto['Nombre'],
                        'Descripcion' => $producto['Descripcion'],
                        'Precio' => $producto['Precio'],
                        'Stock' => $producto['Stock'],
                        'IdCategoria' => $producto['IdCategoria'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $this->texto .= "Producto '{$producto['Nombre']}' creado correctamente. <br>";
                } else {
                    $this->texto .= "Error: La categoría con IdCategoria '{$producto['IdCategoria']}' no existe para el producto '{$producto['Nombre']}'. <br>";
                }
            } catch (\Exception $e) {
                $this->texto .= "Error al crear el producto '{$producto['Nombre']}': {$e->getMessage()}<br>";
            }
        }
    }

    // Método para mostrar datos de cualquier tabla
    public function mostrarDatos($nom_tabla)
    {
        try {
            // Verificar si la tabla existe
            if (!Schema::hasTable($nom_tabla)) {
                return "La tabla '{$nom_tabla}' no existe.";
            }

            // Obtener los datos de la tabla
            $datos = DB::table($nom_tabla)->get();

            // Verificar si hay datos
            if ($datos->isEmpty()) {
                return "La tabla '{$nom_tabla}' está vacía.";
            }

            // Mostrar los datos en formato HTML
            return view('vista_tabla', ['datos' => $datos]);
        } catch (\Exception $e) {
            return " Error al mostrar los datos de la tabla '{$nom_tabla}': " . $e->getMessage();
        }
    }
}
    


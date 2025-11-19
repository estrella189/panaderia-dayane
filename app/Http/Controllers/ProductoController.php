<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;

class ProductoController extends Controller
{
    public function publicoPorCategoria(string $categoria)
    {
        $slug = Str::slug(trim($categoria), '-');

        $mapVistas = [
            'chocolate' => 'pasteles.chocolate',
            'eventos'   => 'pasteles.eventos',
            'temporada' => 'pasteles.temporada',
            'rollos'    => 'pasteles.rollos',
            'frutas'    => 'pasteles.frutas',
        ];

        abort_unless(isset($mapVistas[$slug]), 404);

        $mapSubcategorias = [
            'chocolate' => 6,
            'eventos'   => 7,
            'temporada' => 5,
            'rollos'    => 4,
            'frutas'    => 8,
        ];

        $productos = collect();

        if (isset($mapSubcategorias[$slug])) {
            $productos = Producto::where('id_subcategoria', $mapSubcategorias[$slug])
                ->orderBy('nombre')
                ->get();
        }

        return view($mapVistas[$slug], compact('productos'));
    }

    public function index()
    {
        $productos = Producto::with('subcategoria.categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_subcategoria' => 'required|exists:subcategorias,id',
            'nombre'          => 'required',
            'descripcion'     => 'nullable',
            'imagen'          => 'nullable|image'
        ]);

        $producto = new Producto();
        $producto->id_subcategoria = $request->id_subcategoria;
        $producto->nombre          = $request->nombre;
        $producto->descripcion     = $request->descripcion;

        if ($request->hasFile('imagen')) {

            $sub = Subcategoria::find($request->id_subcategoria);

            // Carpeta por subcategoría
            $mapCarpetas = [
                6 => 'chocolate',
                7 => 'eventos',
                5 => 'temporada',
                4 => 'rollos',
                8 => 'frutas',
            ];

            $carpeta = $mapCarpetas[$sub->id] ?? 'otros';

            // Nombre del archivo
            $nombreArchivo = time() . '.' . $request->imagen->extension();

            // Ruta final en public/
            $rutaCarpetaPublic = public_path("img/pasteles/{$carpeta}");
            if (!is_dir($rutaCarpetaPublic)) {
                mkdir($rutaCarpetaPublic, 0775, true);
            }

            // Guardar archivo
            $request->imagen->move($rutaCarpetaPublic, $nombreArchivo);

            // Guardar ruta en la BD
            $producto->imagen = "img/pasteles/{$carpeta}/{$nombreArchivo}";
        }

        $producto->save();

        return redirect()->route('admin.productos.index')->with('ok', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::where(
            'id_categoria',
            $producto->subcategoria->id_categoria
        )->get();

        return view('admin.productos.edit', compact('producto', 'categorias', 'subcategorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'id_subcategoria' => 'required|exists:subcategorias,id',
            'nombre'          => 'required',
            'descripcion'     => 'nullable',
            'imagen'          => 'nullable|image'
        ]);

        $producto->id_subcategoria = $request->id_subcategoria;
        $producto->nombre          = $request->nombre;
        $producto->descripcion     = $request->descripcion;

        if ($request->hasFile('imagen')) {

            // Borrar la imagen anterior
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                @unlink(public_path($producto->imagen));
            }

            $sub = Subcategoria::find($request->id_subcategoria);

            $mapCarpetas = [
                6 => 'chocolate',
                7 => 'eventos',
                5 => 'temporada',
                4 => 'rollos',
                8 => 'frutas',
            ];

            $carpeta = $mapCarpetas[$sub->id] ?? 'otros';

            $nombreArchivo = time() . '.' . $request->imagen->extension();

            $rutaCarpetaPublic = public_path("img/pasteles/{$carpeta}");
            if (!is_dir($rutaCarpetaPublic)) {
                mkdir($rutaCarpetaPublic, 0775, true);
            }

            $request->imagen->move($rutaCarpetaPublic, $nombreArchivo);

            $producto->imagen = "img/pasteles/{$carpeta}/{$nombreArchivo}";
        }

        $producto->save();

        return redirect()->route('admin.productos.index')->with('ok', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->imagen && file_exists(public_path($producto->imagen))) {
            @unlink(public_path($producto->imagen));
        }

        $producto->delete();
        return redirect()->route('admin.productos.index')->with('ok', 'Producto eliminado correctamente.');
    }

    public function getSubcategorias($id)
    {
        return Subcategoria::where('id_categoria', $id)->get();
    }
}

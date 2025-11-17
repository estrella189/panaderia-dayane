<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;

class ProductoController extends Controller
{
    // ==== CATÁLOGO PÚBLICO (requiere login, pero NO rol admin) ====
    public function publicoPorCategoria(string $categoria)
    {
        $slug = Str::slug(trim($categoria), '-');

        $map = [
            'chocolate'          => 'pasteles.chocolate',
            'eventos'            => 'pasteles.eventos',
            'temporada'          => 'pasteles.temporada',
            'rollos'             => 'pasteles.rollos',
            'frutas'             => 'pasteles.frutas',
        ];

        abort_unless(isset($map[$slug]), 404);

        return view($map[$slug]);
    }
public function index()
    {
        $productos = Producto::with('subcategoria.categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_subcategoria' => 'required|exists:subcategorias,id',
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image'
        ]);

        $producto = new Producto();
        $producto->id_subcategoria = $request->id_subcategoria;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            $nombre = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('imagenes'), $nombre);
            $producto->imagen = $nombre;
        }

        $producto->save();

        return redirect()->route('admin.productos.index');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::where(
            'id_categoria',
            $producto->subcategoria->id_categoria
        )->get();

        return view('productos.edit', compact('producto', 'categorias', 'subcategorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'id_subcategoria' => 'required|exists:subcategorias,id',
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image'
        ]);

        $producto->id_subcategoria = $request->id_subcategoria;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            $nombre = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('imagenes'), $nombre);
            $producto->imagen = $nombre;
        }

        $producto->save();

        return redirect()->route('admin.productos.index');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->imagen && file_exists(public_path('imagenes/' . $producto->imagen))) {
            unlink(public_path('imagenes/' . $producto->imagen));
        }

        $producto->delete();
        return redirect()->route('productos.index');
    }

    public function getSubcategorias($id)
    {
        return Subcategoria::where('id_categoria', $id)->get();
    }

}
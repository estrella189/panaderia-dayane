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
            'pasteles-de-frutas' => 'pasteles.frutas', // alias
        ];

        abort_unless(isset($map[$slug]), 404);

        return view($map[$slug]);
    }

    // ==== PANEL ADMINISTRATIVO ====

    // Mostrar lista de productos
    public function index()
    {
        $productos = Producto::with(['categoria', 'subcategoria'])->get();
        return view('admin.productos.index', compact('productos'));
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('admin.productos.create', compact('categorias', 'subcategorias'));
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'id_categoria' => 'required|exists:categorias,id',
            'id_subcategoria' => 'required|exists:subcategorias,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagen = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_categoria' => $request->id_categoria,
            'id_subcategoria' => $request->id_subcategoria,
            'imagen' => $imagen,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente.');
    }

    // Mostrar formulario para editar producto
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias', 'subcategorias'));
    }

    // Actualizar producto
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'id_categoria' => 'required|exists:categorias,id',
            'id_subcategoria' => 'required|exists:subcategorias,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_categoria' => $request->id_categoria,
            'id_subcategoria' => $request->id_subcategoria,
            'imagen' => $producto->imagen,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}

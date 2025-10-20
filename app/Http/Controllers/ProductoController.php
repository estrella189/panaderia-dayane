<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\productos;
use App\Models\categorias;

class ProductoController extends Controller
{
    // ==== CATÁLOGO PÚBLICO (requiere login, pero NO rol admin) ====
    public function publicoPorCategoria(string $categoria)
    {
        // Si por ahora son vistas estáticas con imágenes:
        return view(match ($categoria) {
        'chocolate' => 'pasteles.chocolate',
        'frutas'    => 'pasteles.frutas',
        'eventos'   => 'pasteles.eventos',
        'temporada' => 'pasteles.temporada',
        'rollos'    => 'pasteles.rollos',  
            default     => abort(404),
        });
    }

    public function catalogo()
    {
        $productos = productos::orderBy('Nombre')->get();
        return view('productos.catalogo', compact('productos'));
    }

    /* ======== CRUD (ADMIN) ======== */
    public function index()
    {
        $productos = productos::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = categorias::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre'      => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Precio'      => 'required|numeric',
            'Stock'       => 'required|integer',
            'IdCategoria' => 'required|exists:categorias,IdCategoria',
        ]);

        productos::create($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto agregado correctamente.');
    }

    public function edit($id)
    {
        $producto   = productos::findOrFail($id);
        $categorias = categorias::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre'      => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Precio'      => 'required|numeric',
            'Stock'       => 'required|integer',
            'IdCategoria' => 'required|exists:categorias,IdCategoria',
        ]);

        $producto = productos::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = productos::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}

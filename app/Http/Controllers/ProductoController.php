<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;      // Tu modelo de productos
use App\Models\categorias;     // Para cargar la categoría en los formularios

class ProductoController extends Controller
{
    // Listar productos
    public function index()
    {
        $productos = productos::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario para crear un nuevo producto
    public function create()
    {
        // Obtener categorías para el select del formulario
        $categorias = categorias::all();
        return view('productos.create', compact('categorias'));
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'Nombre'      => 'required',
            'Descripcion' => 'nullable',
            'Precio'      => 'required|numeric',
            'Stock'       => 'required|integer',
            'IdCategoria' => 'required|exists:categorias,IdCategoria',
        ]);

        productos::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente.');
    }

    // Mostrar formulario para editar un producto
    public function edit($id)
    {
        $producto = productos::findOrFail($id);
        $categorias = categorias::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre'      => 'required',
            'Descripcion' => 'nullable',
            'Precio'      => 'required|numeric',
            'Stock'       => 'required|integer',
            'IdCategoria' => 'required|exists:categorias,IdCategoria',
        ]);

        $producto = productos::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = productos::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}

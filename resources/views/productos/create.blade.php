@extends('productos.app')

@section('content')
<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-top: 40px;
    }
    
    h1 {
        color: #5c3a21;
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
        border-bottom: 2px solid #e8d5b5;
        padding-bottom: 10px;
    }
    
    .form-label {
        color: #5c3a21;
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #e0d6c2;
        border-radius: 4px;
        background-color: #f8f4ec;
        transition: all 0.3s ease;
        color: #5c3a21;
    }
    
    .form-control:focus {
        border-color: #8b6b3d;
        box-shadow: 0 0 0 0.25rem rgba(139, 107, 61, 0.25);
        background-color: #fff;
        outline: none;
    }
    
    .mb-3 {
        margin-bottom: 20px;
    }
    
    .btn-success {
        background-color: #6b8e23;
        border-color:rgb(122, 114, 31);
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
    }
    
    .btn-success:hover {
        background-color: #5c7a1f;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%235c3a21'%3e%3cpath d='M7 10l5 5 5-5z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 20px;
    }
    
    option[value=""] {
        color: #999;
    }
</style>

<div class="container mt-5">
    <h1>Agregar Nuevo Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" name="Nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Descripcion" class="form-label">Descripción</label>
            <input type="text" name="Descripcion" class="form-control">
        </div>
        <div class="mb-3">
            <label for="Precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="Precio" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Stock" class="form-label">Stock</label>
            <input type="number" name="Stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="IdCategoria" class="form-label">Categoría</label>
            <select name="IdCategoria" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->IdCategoria }}">{{ $categoria->NombreCategoria }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar Producto</button>
    </form>
</div>
@endsection
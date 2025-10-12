@extends('productos.app')

@section('content')
<style>
    :root {
        --primary:rgba(129, 65, 1, 0.86);
        --primary-dark:rgba(108, 53, 5, 0.76);
        --secondary:#5c3a21;
        --light:#FFF8F0;
        --lighter:#F5E9DC;
        --lightest:#EDE0D1;
        --border:#D4B996;
        --warning:#E3B04B;
        --warning-dark:#D4A037;
        --danger:#C45C4D;
        --danger-dark:#B34C3D;
        --shadow:0 4px 20px rgba(93,64,55,0.1);
    }

    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: white;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }

    /* Botón regresar (como en panel empleado) */
    .back-btn{
        background:#ffffff18;
        color:var(--secondary);
        text-decoration:none;
        border:1px solid var(--border);
        border-radius:10px;
        padding:10px 14px;
        font-weight:600;
        display:inline-flex;
        align-items:center;
        gap:6px;
        transition:background .2s ease, transform .12s ease;
        margin-bottom:1.2rem;
    }
    .back-btn:hover{
        background:var(--lighter);
        transform:translateY(-1px);
    }

    h1 {
        color: var(--secondary);
        text-align: center;
        margin-bottom: 2rem;
        font-weight: 700;
        font-size: 2.2rem;
        position: relative;
        padding-bottom: 1rem;
    }
    h1::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 150px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--warning));
        border-radius: 3px;
    }

    .btn-primary {
        background-color: var(--primary);
        border: none;
        padding: 0.8rem 1.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 8px;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(166, 124, 82, 0.2);
        display: inline-flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(166, 124, 82, 0.3);
    }
    .btn-primary i { margin-right: 8px; }

    .table-container { overflow-x:auto; border-radius:10px; box-shadow:var(--shadow); }
    .table { width:100%; border-collapse:separate; border-spacing:0; min-width:800px; }
    .table thead tr {
        background:linear-gradient(135deg,var(--primary),var(--secondary));
        color:white;
    }
    .table th {
        padding:1.2rem 1.5rem; font-weight:600; text-align:left;
        font-size:0.9rem; letter-spacing:0.5px;
    }
    .table th:first-child { border-top-left-radius:10px; }
    .table th:last-child { border-top-right-radius:10px; }
    .table td {
        padding:1.2rem 1.5rem;
        border-bottom:1px solid var(--border);
        color:var(--secondary);
        transition:all 0.2s ease;
    }
    .table tbody tr:nth-child(even){ background-color:var(--lighter); }
    .table tbody tr:hover{ background-color:var(--lightest); }

    .price{ font-weight:700; color:var(--primary); }
    .stock-available{ color:var(--primary); font-weight:600; }
    .stock-zero{ color:var(--danger)!important; font-weight:600; }

    .action-buttons{ display:flex; gap:0.5rem; }
    .btn-sm{
        padding:0.5rem 1rem; font-size:0.85rem; border-radius:6px;
        font-weight:500; transition:all 0.2s ease; display:inline-flex;
        align-items:center; justify-content:center; border:none;
    }
    .btn-warning{ background-color:var(--warning); color:white; }
    .btn-warning:hover{ background-color:var(--warning-dark); transform:translateY(-1px); }
    .btn-danger{ background-color:var(--danger); color:white; }
    .btn-danger:hover{ background-color:var(--danger-dark); transform:translateY(-1px); }
    .btn-sm i{ margin-right:5px; font-size:0.9rem; }

    .no-products{ text-align:center; padding:2rem; color:var(--secondary); font-size:1.1rem; }

    @media (max-width:768px){
        .container{ padding:1.5rem; }
        h1{ font-size:1.8rem; }
        .btn-primary{ width:100%; justify-content:center; }
    }
</style>

<div class="container">

    
     @if(auth()->user()->role === 'admin')
        <a href="{{ url()->previous() }}" class="back-btn">⬅️ Regresar</a>
    @endif


    <h1>Listado de Productos</h1>

    <a href="{{ route('productos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Agregar Producto
    </a>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                <tr>
                    <td>{{ $producto->IdProducto }}</td>
                    <td>{{ $producto->Nombre }}</td>
                    <td>{{ $producto->Descripcion ?? '--' }}</td>
                    <td class="price">${{ number_format($producto->Precio, 2) }}</td>
                    <td class="{{ $producto->Stock == 0 ? 'stock-zero' : 'stock-available' }}">{{ $producto->Stock }}</td>
                    <td>{{ $producto->categoria ? $producto->categoria->NombreCategoria : '--' }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('productos.edit', $producto->IdProducto) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('productos.destroy', $producto->IdProducto) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="no-products">No hay productos registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

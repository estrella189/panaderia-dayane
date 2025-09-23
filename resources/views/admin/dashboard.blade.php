@extends('layouts.app') {{-- si tienes un layout general, si no puedes quitarlo --}}

@section('content')
<div class="container">
    <h1>Panel de Administrador</h1>
    <p>Bienvenido, {{ auth()->user()->name }} (Rol: {{ auth()->user()->role }})</p>
    <ul>
        <li><a href="{{ route('empleado.panel') }}">Ver Panel Empleado</a></li>
        <li><a href="{{ route('cliente.inicio') }}">Ver Página Cliente</a></li>
    </ul>
</div>
@endsection

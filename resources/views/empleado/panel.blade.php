@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Empleado</h1>
    <p>Bienvenido, {{ auth()->user()->name }} (Rol: {{ auth()->user()->role }})</p>
</div>
@endsection

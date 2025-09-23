@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Página de Cliente</h1>
    <p>Hola {{ auth()->user()->name }}, este es tu inicio.</p>
</div>
@endsection

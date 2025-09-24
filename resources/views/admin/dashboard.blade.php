<h1>Panel de Administrador</h1>
<p>Bienvenido, {{ auth()->user()->name }}.</p>

<ul>
  <li><a href="{{ route('productos.index') }}">Gestionar productos</a></li>
  <li><a href="{{ route('empleado.panel') }}">Ver Panel Empleado</a></li>
  <li><a href="{{ route('cliente.inicio') }}">Ver Página Cliente</a></li>
</ul>

<form action="{{ route('logout') }}" method="POST">
  @csrf
  <button type="submit">Cerrar sesión</button>
</form>

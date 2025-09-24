

<h1>Panel de Empleado</h1>
<p>Bienvenido, {{ auth()->user()->name }}.</p>
<form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">Cerrar sesión</button></form>

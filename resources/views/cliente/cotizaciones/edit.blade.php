<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar cotización</title>
  <style>
    body{
      font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
      background:#f5f5f5;
      margin:0;
      padding:20px;
    }
    .container{
      max-width:600px;
      margin:20px auto;
      background:#fff;
      padding:20px;
      border-radius:10px;
      box-shadow:0 4px 14px rgba(0,0,0,.12);
    }
    h1{
      margin-top:0;
      color:#8b5e3c;
      text-align:center;
    }
    label{
      font-weight:600;
      display:block;
      margin-top:10px;
      margin-bottom:4px;
    }
    textarea{
      width:100%;
      min-height:120px;
      padding:10px;
      border-radius:6px;
      border:1px solid #ccc;
      resize:vertical;
    }
    .btn{
      margin-top:15px;
      padding:10px 16px;
      border:none;
      border-radius:6px;
      background:#8b5e3c;
      color:#fff;
      font-weight:600;
      cursor:pointer;
    }
    .btn-secondary{
      background:#ccc;
      color:#333;
      text-decoration:none;
      display:inline-block;
      padding:10px 16px;
      border-radius:6px;
      margin-right:8px;
    }
    .alert{
      padding:8px 10px;
      margin-bottom:10px;
      border-radius:6px;
      background:#fde8e8;
      color:#8b1a1a;
    }
    .campo-lectura{
      background:#fafafa;
      padding:8px 10px;
      border-radius:6px;
      border:1px solid #eee;
      margin-bottom:6px;
    }
    small{color:#666;}
  </style>
</head>
<body>

  <div class="container">
    <h1>Editar cotización #{{ $cotizacion->id }}</h1>

    <p class="campo-lectura">
      <strong>Producto:</strong>
      {{ $cotizacion->producto->nombre ?? '—' }}
    </p>

    <p class="campo-lectura">
      <strong>Estado actual:</strong> {{ ucfirst($cotizacion->estado) }}
      <br>
      <small>Al guardar, la cotización volverá a estado <strong>pendiente</strong> para que el administrador la recalcule.</small>
    </p>

    @if ($errors->any())
      <div class="alert">
        <ul style="margin:0;padding-left:18px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('cliente.cotizaciones.update', $cotizacion->id) }}">
      @csrf
      @method('PUT')

      <label for="mensaje">Descripción / detalles del pastel</label>
      <textarea name="mensaje" id="mensaje" required>{{ old('mensaje', $cotizacion->mensaje ?? '') }}</textarea>
      <small>Por ejemplo: tamaño, sabores, decoración, texto del pastel, colores, etc.</small>

      <div style="margin-top:15px;">
        <a href="{{ route('cliente.cotizaciones.show', $cotizacion->id) }}" class="btn-secondary">Cancelar</a>
        <button type="submit" class="btn">Guardar cambios</button>
      </div>
    </form>
  </div>

</body>
</html>

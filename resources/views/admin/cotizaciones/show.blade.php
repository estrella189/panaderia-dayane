<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle de cotización — Dayane</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Roboto, sans-serif;
      background: #fdf8f4;
      color: #3a281c;
    }
    header {
      background-color: #8b5e3c;
      color: #fff;
      padding: 16px;
      text-align: center;
      font-weight: bold;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 12px rgba(0,0,0,.15);
    }
    .container {
      max-width: 960px;
      margin: 2rem auto;
      padding: 1.5rem;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 14px rgba(0,0,0,.1);
    }
    h2 {
      margin-top: 0;
      font-size: 1.5rem;
      border-bottom: 2px solid #f2e0d0;
      padding-bottom: 0.5rem;
      color: #6a452a;
    }
    .card {
      border: 1px solid #e7d5c3;
      border-radius: 10px;
      background: #fffaf7;
      box-shadow: 0 2px 8px rgba(0,0,0,.05);
      margin-bottom: 1.5rem;
    }
    .card-header {
      background: #f4e4d8;
      padding: 12px 16px;
      border-bottom: 1px solid #e0c9b6;
      border-radius: 10px 10px 0 0;
      font-weight: bold;
    }
    .card-body {
      padding: 1rem 1.5rem;
    }
    p {
      margin: 6px 0;
    }
    .badge {
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 0.9rem;
      font-weight: 600;
      color: #fff;
    }
    .bg-warning { background-color: #e3b04b; }
    .bg-primary { background-color: #8b5e3c; }

    input, textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #d8c2ad;
      border-radius: 8px;
      font-size: 1rem;
      background: #fffdfb;
    }
    textarea { resize: vertical; }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #5c3a21;
    }

    .btn {
      display: inline-block;
      padding: 10px 18px;
      border-radius: 8px;
      border: none;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      font-size: 0.95rem;
    }
    .btn-primary {
      background-color: #8b5e3c;
      color: #fff;
    }
    .btn-light {
      background: #f4e8df;
      color: #5c3a21;
      border: 1px solid #dbc5b0;
    }
    .btn-outline-secondary {
      background: transparent;
      border: 1px solid #a88a70;
      color: #5c3a21;
    }
    .alert {
      padding: 10px 14px;
      border-radius: 8px;
      margin-bottom: 1rem;
      font-weight: 500;
    }
    .alert-success { background: #e7f7ea; border: 1px solid #b3e3b3; color: #2b6b2b; }
    .alert-danger  { background: #fde8e8; border: 1px solid #f4b2b2; color: #8b1a1a; }

  </style>
</head>
<body>
  <header>Detalle de Cotización — Panadería y Pastelería Dayane</header>

  <div class="container">
    <h2>Detalle de cotización</h2>

    @if(session('ok'))    <div class="alert alert-success">{{ session('ok') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="card">
      <div class="card-body">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
          <div>
            <p><strong>Folio:</strong> #{{ $cotizacion->id }}</p>
            <p><strong>Fecha:</strong> {{ optional($cotizacion->created_at)->format('d/m/Y H:i') ?? '—' }}</p>
            <p>
              <strong>Estado:</strong>
              <span class="badge bg-{{ $cotizacion->estado === 'pendiente' ? 'warning' : 'primary' }}">
                {{ ucfirst($cotizacion->estado) }}
              </span>
            </p>
          </div>
          <div>
            <p><strong>Cliente:</strong> {{ $cotizacion->cliente->name ?? '—' }}</p>
            <p><strong>Email:</strong> {{ $cotizacion->cliente->email ?? '—' }}</p>
          </div>
        </div>
        <hr>
        <p><strong>Producto:</strong> {{ $cotizacion->producto->nombre ?? '—' }}</p>
        <p><strong>Detalles:</strong> {{ $cotizacion->detalles ?: '—' }}</p>
        <p>
          <strong>Precio:</strong>
          @if($cotizacion->estado === 'cotizado' && !is_null($cotizacion->precio))
              ${{ number_format($cotizacion->precio,2) }}
          @else
              —
          @endif
        </p>
      </div>
    </div>

    @if($cotizacion->estado === 'pendiente')
    <div class="card">
      <div class="card-header">Responder cotización</div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.cotizaciones.responder', $cotizacion) }}">
          @csrf
          <div class="mb-3">
            <label>Precio (MXN)</label>
            <input type="number" step="0.01" min="0" name="precio" required>
          </div>
          <div class="mb-3">
            <label>Mensaje para el cliente (opcional)</label>
            <textarea name="respuesta_extra" rows="3" placeholder="Tiempos, condiciones, observaciones…"></textarea>
          </div>
          <button class="btn btn-primary">Enviar cotización</button>
          <a href="{{ route('admin.cotizaciones.index') }}" class="btn btn-light">Volver</a>
        </form>
      </div>
    </div>
    @else
    <a href="{{ route('admin.cotizaciones.index') }}" class="btn btn-outline-secondary">Volver al listado</a>
    @endif
  </div>
</body>
</html>

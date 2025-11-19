<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel del Cliente (Admin)</title>

  <style>
    body{font-family:Arial;background:#f5f5f5;margin:0;padding:20px;}
    h1{color:#8b5e3c;text-align:center;margin-bottom:10px;}
    .box{max-width:1000px;margin:30px auto;background:white;padding:20px;border-radius:12px;
         box-shadow:0 4px 16px rgba(0,0,0,.1);}
    table{width:100%;border-collapse:collapse;margin-top:15px;}
    th,td{padding:12px;border:1px solid #ddd;text-align:left;}
    th{background:#8b5e3c;color:#fff;}
    tr:nth-child(even){background:#fafafa;}
    .btn{display:inline-block;background:#8b5e3c;color:#fff;padding:10px 16px;border-radius:6px;
        text-decoration:none;margin-bottom:20px;}
  </style>
</head>

<body>

  <a href="{{ route('admin.clientes.seleccionar') }}" class="btn">⬅ Regresar</a>

  <div class="box">
    <h1>Pedidos del Cliente</h1>

    @if($pedidos->isEmpty())
      <p style="text-align:center">Este cliente no tiene pedidos.</p>
    @else
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pedidos as $p)
          <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ ucfirst($p->estado) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>


  <div class="box">
    <h1>Cotizaciones del Cliente</h1>

    @if($ultimas->isEmpty())
      <p style="text-align:center">Este cliente no tiene cotizaciones.</p>
    @else
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Estado</th>
            <th>Precio</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          @foreach($ultimas as $c)
          <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->producto->nombre ?? '---' }}</td>
            <td>{{ ucfirst($c->estado) }}</td>
            <td>
              @if($c->precio)
                ${{ number_format($c->precio,2) }}
              @else
                —
              @endif
            </td>
            <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

</body>
</html>

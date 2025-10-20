<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo — Panadería y Pastelería Dayane</title>
  <style>
    body{margin:0;font-family:system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,Arial,sans-serif;background:#f5f5f5;color:#333}
    header{background:#8b5e3c;color:#fff;padding:18px;text-align:center;box-shadow:0 4px 12px rgba(0,0,0,.1)}
    main{max-width:1100px;margin:24px auto;padding:0 16px}
    .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px}
    .card{background:#fff;border:1px solid #eadfcc;border-radius:14px;box-shadow:0 8px 18px rgba(0,0,0,.06);padding:14px;display:grid;gap:10px}
    .img{width:100%;height:170px;object-fit:cover;border-radius:10px;border:1px solid #eee;background:#fafafa}
    .price{color:#6b4d38}
    .row{display:grid;grid-template-columns:1fr auto;gap:8px;align-items:center}
    input[type=number]{padding:10px;border:1px solid #d9c9b3;border-radius:10px}
    .btn{background:#8b5e3c;color:#fff;border:none;padding:10px 14px;border-radius:10px;cursor:pointer;text-decoration:none;display:inline-block;text-align:center}
    .login{background:#a97e5a}
    .flash{background:#e9f9ee;border:1px solid #bde5c8;color:#2d6a4f;padding:10px 12px;border-radius:10px;margin-bottom:14px}
  </style>
</head>
<body>
<header>
  <h1>Catálogo de productos</h1>
  <p>Panadería y Pastelería Dayane</p>
</header>

<main>
  @if(session('ok')) <div class="flash">{{ session('ok') }}</div> @endif

  <div class="grid">
    @forelse($productos as $p)
      <article class="card">
        <img class="img" src="{{ $p->ImagenUrl ?? '/prodcts.webp' }}" alt="{{ $p->Nombre }}">
        <h3 style="margin:0">{{ $p->Nombre }}</h3>
        <p style="margin:0">{{ $p->Descripcion }}</p>
        <div class="price">
          Precio: <strong>${{ number_format($p->Precio,2) }}</strong>
          @if(isset($p->Stock)) <span style="color:#777"> · Stock: {{ $p->Stock }}</span> @endif
        </div>

        <form class="row" action="{{ route('pedidos.store') }}" method="POST">
          @csrf
          <input type="hidden" name="producto_id" value="{{ $p->IdProducto }}">
          <input type="number" name="cantidad" min="1" value="1" {{ (isset($p->Stock) && $p->Stock<=0) ? 'disabled' : '' }}>
          @auth
            <button type="submit" class="btn" {{ (isset($p->Stock) && $p->Stock<=0) ? 'disabled' : '' }}>Pedir</button>
          @else
            <a href="{{ route('login') }}" class="btn login">Inicia sesión</a>
          @endauth
        </form>
      </article>
    @empty
      <p>No hay productos disponibles por ahora.</p>
    @endforelse
  </div>
</main>
</body>
</html>


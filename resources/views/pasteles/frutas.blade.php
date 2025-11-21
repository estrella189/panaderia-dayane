<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="icono.png" type="image/png">
  <title>Pasteles de Frutas</title>
  <style>
    :root{ --cafe-oscuro:#8b5e3c; --cafe-medio:#a97e5a; --texto:#333; --bg:#f5f5f5; --sombra:0 8px 24px rgba(0,0,0,.12); --sombra-hover:0 14px 30px rgba(0,0,0,.16); --radius-xl:24px; }
    *{box-sizing:border-box}
    body{ margin:0; font-family:'Trebuchet MS','Lucida Sans Unicode','Lucida Grande','Lucida Sans',Arial,sans-serif; background:#f9f6f3; color:var(--texto); }

    header{
      background:linear-gradient(135deg, #956644, #7b5436);
      color:#fff;
      padding:28px 18px;
      display:flex;
      justify-content:center;
      align-items:center;
      text-align:center;
      box-shadow:var(--sombra);
      position:relative;
    }

    header h1{
      margin:0;
      font-size:clamp(22px, 3.2vw, 36px);
      display:flex;
      align-items:center;
      gap:12px;
      font-weight:700;
    }

    /* 🔙 Botón regresar */
    .btn-back{
      background:#ffffff22;
      border:1px solid #ffffff44;
      padding:8px 14px;
      border-radius:12px;
      color:#fff;
      text-decoration:none;
      font-weight:600;
      position:absolute;
      left:18px;
      top:20px;
    }
    .btn-back:hover{
      background:#ffffff33;
    }

    main{ max-width:1100px; margin:28px auto 60px; padding:0 16px; }

    .flash{ max-width:1100px;margin:10px auto 0; padding:10px 14px; border-radius:12px; }
    .flash.ok{ background:#e7f7ee; color:#1f7a43; border:1px solid #b9e6cb; }
    .flash.error{ background:#fdeaea; color:#a12b2b; border:1px solid #f3c2c2; }

    section.products{
      display:grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap:22px;
      padding:18px 0;
    }

    .product-card{
      background:#fff;
      border-radius:var(--radius-xl);
      overflow:hidden;
      box-shadow:var(--sombra);
      transition:.2s;
    }
    .product-card:hover{
      transform: translateY(-4px);
      box-shadow:var(--sombra-hover);
    }

    .product-card img{
      width:100%;
      height:280px;
      object-fit:contain;
      background-color:#fff;
      padding:10px;
      border-bottom:1px solid #eee;
    }

    .card-body{ padding:14px 14px 18px; display:grid; gap:10px; }

    .btn{
      padding:10px 14px;
      border-radius:999px;
      border:none;
      color:#fff;
      background:#8b5e3c;
      cursor:pointer;
    }

    .input, .select{
      width:100%;
      padding:8px;
      border:1px solid #ddd;
      border-radius:10px;
    }

    label{ font-size:14px; display:grid; gap:6px; }

    /* Tablets */
@media (max-width: 992px){
  header{
    padding:22px 14px;
  }
  header h1{
    gap:10px;
    font-size:clamp(20px,3vw,30px);
  }
  main{
    margin:22px auto 48px;
    padding:0 14px;
  }
  section.products{
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:18px;
  }
  .product-card img{
    height:240px;
  }
}

/* Celulares grandes */
@media (max-width: 768px){
  header{
    padding:18px 12px;
  }
  header h1{
    font-size:20px;
    gap:8px;
  }
  main{
    margin:18px auto 40px;
    padding:0 12px;
  }
  section.products{
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:16px;
  }
  .product-card{
    border-radius:18px;
  }
  .product-card img{
    height:210px;
    padding:8px;
  }
}

/* Celulares pequeños */
@media (max-width: 480px){
  header h1{
    font-size:18px;
    gap:6px;
    flex-direction:column;
  }
  section.products{
    grid-template-columns:1fr;
    gap:14px;
  }
  .product-card img{
    height:180px;
  }
}

  </style>
</head>
<body>

  <header>
    <a href="{{ route('cliente.inicio') }}" class="btn-back">⬅️ Volver al inicio</a>
    <h1>Pasteles de Frutas - Dayane</h1>
  </header>

  {{-- Mensajes flash --}}
  @if(session('ok'))
    <div class="flash ok">{{ session('ok') }}</div>
  @endif
  @if(session('error'))
    <div class="flash error">{{ session('error') }}</div>
  @endif

  <main>
    @if($productos->isEmpty())
      <p style="text-align:center;margin-top:20px;">No hay pasteles de frutas registrados.</p>
    @endif

    <section class="products">
      @foreach($productos as $prod)
      <article class="product-card">

        <img src="{{ asset($prod->imagen) }}" alt="{{ $prod->nombre }}">

        <div class="card-body">
          <h3 style="margin:0">{{ $prod->nombre }}</h3>

          @auth
          <form method="POST" action="{{ route('cotizaciones.store') }}" style="display:grid;gap:8px">
            @csrf

            <input type="hidden" name="producto_nombre" value="{{ $prod->nombre }}">

            <label>Cantidad
              <input class="input" type="number" name="cantidad" min="1" value="1" required>
            </label>

            <label>Fecha de entrega
              <input class="input" type="date" name="fecha_entrega">
            </label>

            <label>Mensaje (opcional)
              <input class="input" type="text" name="mensaje_pastel" maxlength="255">
            </label>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
              <label>Tamaño
                <select class="select" name="tamano">
                  <option value="">—</option><option>Chico</option><option>Mediano</option><option>Grande</option>
                </select>
              </label>

              <label>Sabor
                <select class="select" name="sabor">
                  <option value="">—</option><option>Chocolate</option><option>Vainilla</option><option>Fresa</option>
                </select>
              </label>
            </div>

            <button class="btn" type="submit">Pedir cotización</button>

          </form>

          @else
            <a href="{{ route('login') }}" class="btn" style="display:inline-block;text-decoration:none;text-align:center">Inicia sesión para cotizar</a>
          @endauth

        </div>
      </article>
      @endforeach
    </section>
  </main>

</body>
</html>

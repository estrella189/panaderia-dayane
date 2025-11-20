<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cotización #{{ $cotizacion->id }} — Panadería y Pastelería Dayane</title>

    <style>
        :root{
            --bg:#fff9f4;
            --card:#ffffff;
            --text:#3a281c;
            --muted:#6f533f;
            --brand:#8b5e3c;
            --brand-2:#a97e5a;
            --shadow:0 12px 30px rgba(139,94,60,.18);
            --radius:24px;
        }

        *{margin:0; padding:0; box-sizing:border-box;}

        body{
            font-family:system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, sans-serif;
            background:var(--bg);
            color:var(--text);
        }

        header{
            background:linear-gradient(135deg, var(--brand), var(--brand-2));
            color:#fff;
            padding:14px 18px;
            text-align:center;
            font-weight:600;
        }

        .page{
            max-width:1100px;
            margin:24px auto;
            padding:0 16px;
            display:flex;
            justify-content:center;
        }

        .card{
            background:var(--card);
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            overflow:hidden;
            max-width:380px;
            width:100%;
        }

        .card-img{
            width:100%;
            height:250px;
            object-fit:cover;
            background:#ddd;
        }

        .card-body{
            padding:20px;
        }

        h2{
            font-size:1.2rem;
            margin-bottom:6px;
        }

        .folio{
            font-size:.85rem;
            color:var(--muted);
            margin-bottom:14px;
        }

        .badge{
            background:#ffe8b3;
            color:#8b5e3c;
            padding:3px 9px;
            font-size:.75rem;
            border-radius:999px;
        }

        .field{
            margin-bottom:14px;
        }

        label{
            display:block;
            font-size:.9rem;
            font-weight:600;
            margin-bottom:4px;
        }

        input,
        select{
            width:100%;
            padding:10px 12px;
            border:1px solid #e2d6c6;
            border-radius:12px;
            background:#faf5ef;
            font-size:.9rem;
            outline:none;
        }

        input:focus,
        select:focus{
            border-color:var(--brand-2);
            background:#fff;
            box-shadow:0 0 0 2px rgba(167,126,90,.25);
        }

        .row-2{
            display:flex;
            gap:10px;
        }

        .btn-main{
            width:100%;
            background:var(--brand);
            color:white;
            border:none;
            padding:12px;
            border-radius:999px;
            font-weight:600;
            margin-top:8px;
            cursor:pointer;
            text-align:center;
        }

        .btn-sec-link{
            display:block;
            width:100%;
            background:#d8d8d8;
            color:#333;
            text-decoration:none;
            border-radius:999px;
            padding:12px;
            font-weight:500;
            margin-top:10px;
            text-align:center;
        }

    </style>
</head>
<body>

<header>
    Editar mi cotización
</header>

<div class="page">
    <div class="card">

        {{-- MOSTRAR IMAGEN DEL PASTEL DESDE public/imagenes/... --}}
@if($cotizacion->producto && $cotizacion->producto->imagen)
    <img src="{{ asset($cotizacion->producto->imagen) }}"
         class="card-img"
         alt="{{ $cotizacion->producto->nombre }}">
@else
    <div class="card-img"></div>
@endif


        <div class="card-body">

            <h2>{{ $cotizacion->producto->nombre }}</h2>

            <div class="folio">
                Cotización #{{ $cotizacion->id }}
                <span class="badge">Se pondrá en pendiente</span>
            </div>

            <form action="{{ route('cliente.cotizaciones.update', $cotizacion->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="field">
                    <label>Cantidad</label>
                    <input type="number" name="cantidad" min="1"
                           value="{{ old('cantidad') }}">
                </div>

                <div class="field">
                    <label>Fecha de entrega</label>
                    <input type="date" name="fecha_entrega"
                           value="{{ old('fecha_entrega') }}">
                </div>

                <div class="field">
                    <label>Mensaje (opcional)</label>
                    <input type="text" name="detalles"
                           value="{{ old('detalles') }}"
                           placeholder="Escribe un mensaje personalizado">
                </div>

                <div class="row-2">
                    <div class="field">
                        <label>Tamaño</label>
                        <select name="tamano">
                            <option value="Pequeño">Pequeño</option>
                            <option value="Mediano">Mediano</option>
                            <option value="Grande">Grande</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Sabor</label>
                        <select name="sabor">
                            <option value="Vainilla">Vainilla</option>
                            <option value="Chocolate">Chocolate</option>
                            <option value="Fresa">Fresa</option>
                        </select>
                    </div>
                </div>

                <button class="btn-main" type="submit">
                    Guardar cambios
                </button>

                <a href="{{ route('cliente.cotizaciones.show', $cotizacion->id) }}"
                   class="btn-sec-link">
                    Cancelar
                </a>

            </form>

        </div>
    </div>
</div>

</body>
</html>



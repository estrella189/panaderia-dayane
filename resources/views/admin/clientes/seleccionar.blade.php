<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Cliente</title>

    <style>
        :root{
            --bg:#f5f0e9;
            --card:#ffffff;
            --brand:#8b5e3c;
            --brand-soft:#a97e5a;
            --line:#e5d4c4;
            --text:#3a281c;
            --muted:#6f533f;
            --danger-bg:#fbe4e6;
            --danger-border:#e38c94;
        }

        *{box-sizing:border-box;}

        body{
            margin:0;
            min-height:100vh;
            font-family:'Trebuchet MS', Arial, sans-serif;
            background:
                radial-gradient(900px 600px at 10% 0%, #ffeede 0, #fff 40%),
                linear-gradient(180deg, #fff9f4, var(--bg));
            display:flex;
            align-items:center;
            justify-content:center;
            color:var(--text);
        }

        .container{
            width:100%;
            max-width:540px;
            padding:20px;
        }

        .card{
            background:var(--card);
            border-radius:18px;
            box-shadow:0 16px 40px rgba(0,0,0,.14);
            border:1px solid #00000010;
            overflow:hidden;
        }

        .card-header{
            padding:18px 22px;
            background:linear-gradient(135deg, var(--brand), #7b4f30);
            color:#fff;
            display:flex;
            align-items:center;
            gap:12px;
        }
        .card-icon{
            width:40px;
            height:40px;
            border-radius:14px;
            background:#ffffff20;
            display:grid;
            place-items:center;
            font-size:1.4rem;
            border:1px solid #ffffff40;
        }
        .card-title{
            display:flex;
            flex-direction:column;
        }
        .card-title strong{
            font-size:1.2rem;
            letter-spacing:.4px;
        }
        .card-title span{
            font-size:.9rem;
            opacity:.9;
        }

        .card-body{
            padding:22px 22px 20px;
        }

        /* Botón regresar */
        .back-btn{
            width:100%;
            display:flex;
            justify-content:center;
            align-items:center;
            gap:8px;
            background:#ffffff;
            border:2px solid var(--brand-soft);
            color:var(--brand);
            font-weight:bold;
            padding:10px 0;
            border-radius:12px;
            text-decoration:none;
            margin-bottom:15px;
            transition:.2s ease;
        }
        .back-btn:hover{
            background:var(--brand-soft);
            color:#fff;
            border-color:var(--brand);
            transform:translateY(-2px);
        }

        label{
            display:block;
            margin-bottom:6px;
            font-weight:bold;
            color:var(--text);
            font-size:.95rem;
        }

        select{
            width:100%;
            padding:10px 12px;
            border-radius:10px;
            border:1px solid var(--line);
            font-size:.95rem;
            background:#fdfaf7;
            outline:none;
            transition:border-color .15s ease, box-shadow .15s ease, background .15s ease;
        }
        select:focus{
            border-color:var(--brand-soft);
            box-shadow:0 0 0 3px rgba(169,126,90,.25);
            background:#fff;
        }

        .helper-text{
            margin-top:4px;
            font-size:.83rem;
            color:var(--muted);
        }

        button{
            margin-top:20px;
            width:100%;
            padding:12px 14px;
            border:none;
            border-radius:12px;
            background:linear-gradient(135deg, var(--brand-soft), var(--brand));
            color:#fff;
            font-size:.98rem;
            font-weight:bold;
            cursor:pointer;
            letter-spacing:.3px;
            box-shadow:0 10px 24px rgba(139,94,60,.35);
            transition:transform .12s ease, box-shadow .16s ease, filter .15s ease;
        }
        button:hover{
            filter:brightness(1.02);
            transform:translateY(-1px);
            box-shadow:0 14px 30px rgba(139,94,60,.38);
        }
        button:active{
            transform:translateY(1px);
            box-shadow:0 6px 18px rgba(139,94,60,.30);
        }

        .alert{
            background:var(--danger-bg);
            color:#6f1c25;
            padding:10px 12px;
            border-left:5px solid var(--danger-border);
            margin-bottom:16px;
            border-radius:10px;
            font-size:.9rem;
            display:flex;
            align-items:flex-start;
            gap:8px;
        }
        .alert span{margin-top:1px;}

        .footer-note{
            margin-top:16px;
            text-align:center;
            font-size:.8rem;
            color:var(--muted);
        }
    </style>
</head>

<body>
    <div class="container">

        @if(session('error'))
            <div class="alert">
                <span>⚠️</span>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                <div class="card-icon">🛍️</div>
                <div class="card-title">
                    <strong>Seleccionar cliente</strong>
                    <span>Elige un cliente para ver su panel</span>
                </div>
            </div>

            <div class="card-body">

                {{-- BOTÓN REGRESAR AL PANEL ADMIN --}}
                <a href="{{ route('admin.dashboard') }}" class="back-btn">
                    ⬅️ Regresar al Panel de Administrador
                </a>

                <form action="{{ route('cliente.panel') }}" method="GET">

                    <label for="cliente_id">Cliente</label>

                    <select name="cliente_id" id="cliente_id" required>
                        <option value="">-- Elige un cliente --</option>

                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">
                                {{ $cliente->name }} (ID: {{ $cliente->id }})
                            </option>
                        @endforeach
                    </select>

                    <button type="submit">Ver panel del cliente</button>

                </form>
            </div>
        </div>

        <div class="footer-note">
            Solo visible para administradores.
        </div>
    </div>
</body>
</html>


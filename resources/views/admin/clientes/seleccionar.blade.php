<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Cliente</title>

    <style>
        body{
            margin:0;
            font-family:'Trebuchet MS', Arial, sans-serif;
            background:#f5f5f5;
        }
        .container{
            max-width: 500px;
            margin:60px auto;
            padding:20px;
        }
        .card{
            background:#fff;
            border-radius:10px;
            box-shadow:0 6px 16px rgba(0,0,0,.12);
            overflow:hidden;
        }
        .card-header{
            background:#8b5e3c;
            color:#fff;
            padding:15px;
            font-size:20px;
            font-weight:bold;
        }
        .card-body{
            padding:20px;
        }
        label{
            display:block;
            margin-bottom:6px;
            font-weight:bold;
            color:#333;
        }
        select{
            width:100%;
            padding:10px;
            border-radius:6px;
            border:1px solid #ccc;
            font-size:16px;
        }
        button{
            margin-top:20px;
            width:100%;
            padding:12px;
            border:none;
            border-radius:6px;
            background:#a97e5a;
            color:#fff;
            font-size:17px;
            cursor:pointer;
            transition:.2s;
        }
        button:hover{
            background:#8b5e3c;
        }
        .alert{
            background:#f8d7da;
            color:#842029;
            padding:10px;
            border-left:5px solid #dc3545;
            margin-bottom:15px;
            border-radius:5px;
        }
    </style>
</head>

<body>
    <div class="container">

        @if(session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">Seleccionar Cliente</div>

            <div class="card-body">
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
    </div>
</body>
</html>

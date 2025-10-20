@extends('layouts.app')
@section('title','Detalle de pedido #'.$pedido->id)

@section('content')
@if(session('ok'))
  <div style="padding:10px;background:#e7f7ee;border:1px solid #b7ebc6;border-radius:10px;margin-bottom:12px;">
    {{ session('ok') }}
  </div>
@endif

<h1>Pedido #{{ $pedido->id }}</h1>
<p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
<p><strong>Fecha de entrega:</strong> {{ $pedido->fecha_entrega ?? '—' }}</p>
<p><strong>Notas:</strong> {{ $pedido->notas ?? '—' }}</p>

<table style="width:100%;border-collapse:collapse;background:#fff;margin-top:12px;">
  <thead>
    <tr style="background:#f5f5f5;">
      <th style="text-align:left;padding:10px;">Producto</th>
      <th style="text-align:right;padding:10px;">Cant.</th>
      <th style="text-align:right;padding:10px;">Precio</th>
      <th style="text-align:right;padding:10px;">Importe</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pedido->items as $it)
      @php
        $nombre = $it->personalizacion['nombre'] ?? 'Pastel';
        $tamano = $it->personalizacion['tamano'] ?? null;
        $sabor  = $it->personalizacion['sabor'] ?? null;
      @endphp
      <tr>
        <td style="padding:10px;">
          {{ $nombre }}
          <div style="color:#666;font-size:14px;">
            @if($tamano) Tamaño: {{ $tamano }} @endif
            @if($sabor) &middot; Sabor: {{ $sabor }} @endif
          </div>
        </td>
        <td style="padding:10px;text-align:right;">{{ $it->cantidad }}</td>
        <td style="padding:10px;text-align:right;">${{ number_format($it->precio_unit,2) }}</td>
        <td style="padding:10px;text-align:right;">${{ number_format($it->cantidad * $it->precio_unit,2) }}</td>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" style="padding:10px;text-align:right;font-weight:700;">Total</td>
      <td style="padding:10px;text-align:right;font-weight:700;">${{ number_format($pedido->total,2) }}</td>
    </tr>
  </tfoot>
</table>
@endsection

@extends('pedidos.app')
@section('title','Mis pedidos')

@section('content')
<h1 style="margin:18px 0;">Mis pedidos</h1>

@if(session('ok'))
  <div style="padding:10px;background:#e7f7ee;border:1px solid #b7ebc6;border-radius:10px;margin-bottom:12px;">
    {{ session('ok') }}
  </div>
@endif

<table style="width:100%;border-collapse:collapse;background:#fff;">
  <thead>
    <tr style="background:#f5f5f5;">
      <th style="text-align:left;padding:10px;">#</th>
      <th style="text-align:left;padding:10px;">Fecha entrega</th>
      <th style="text-align:left;padding:10px;">Estado</th>
      <th style="text-align:right;padding:10px;">Total</th>
      <th style="padding:10px;"></th>
    </tr>
  </thead>
  <tbody>
    @forelse($pedidos as $p)
      <tr>
        <td style="padding:10px;">{{ $p->id }}</td>
        <td style="padding:10px;">{{ $p->fecha_entrega ? $p->fecha_entrega->format('Y-m-d') : '—' }}</td>
        <td style="padding:10px;">{{ ucfirst($p->estado) }}</td>
        <td style="padding:10px;text-align:right;">${{ number_format($p->total,2) }}</td>
        <td style="padding:10px;"><a href="{{ route('pedidos.show',$p) }}">Ver</a></td>
      </tr>
    @empty
      <tr><td colspan="5" style="padding:10px;">Aún no tienes pedidos.</td></tr>
    @endforelse
  </tbody>
</table>

<div style="margin-top:12px;">{{ $pedidos->links() }}</div>
@endsection

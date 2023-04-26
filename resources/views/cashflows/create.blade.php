@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Apertura de caja</h1>
    {{-- <a href="{{route('products.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Apertura de Caja</a> --}}
@endsection

@section('content')

<form method="POST" action="{{ route('cash-flow.store') }}">
    @csrf
    <div class="form-group">
      <label for="start">Dinero inicial en Caja:</label>
      <input type="number" class="form-control" step="0.01" id="start" name="start" required>
    </div>
    <div class="form-group">
      <label for="inicio">Inicio de turno:</label>
      <input type="datetime-local" class="form-control" id="inicio" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" name="inicio" required>
    </div>
    <div class="form-group">
      <label for="fin">Fin de truno:</label>
      <input type="datetime-local" class="form-control" id="fin" value="{{ \Carbon\Carbon::now()->addHours(8)->format('Y-m-d\TH:i') }}" name="fin" required>
    </div>
    <button type="submit" class="btn btn-primary">Abrir Caja</button>
  </form>
  
  
@endsection



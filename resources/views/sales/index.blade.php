@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Ventas</h1>
    <a href="{{ route('sales.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Nueva Venta</a>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Fecha y Hora</th>
                            <th>Estado</th>
                            <th>Efectivo</th>
                            <th>Tarjeta</th>
                            <th>Total</th>                          
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td><a href="{{ route('sales.show', $sale) }}">{{ $sale->id }}</a></td>
                                <td>{{ $sale->sale_date }}</td>
                                <td></td>
                                <td>{{ $sale->cash }}</td>
                                <td>{{ $sale->card }}</td>
                                <td>{{ $sale->total }}</td>

                                {{-- @if ($sale->status == 'VALID')
                                    <td>
                                        <a href="{{ route('change_status.sales', $sale) }}" class="btn btn-outline-success">
                                            Activa<i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('change_status.sales', $sale) }}" class="btn btn-outline-danger">
                                            Cancelada<i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                @endif --}}

                                <td>
                                    <form action="{{ route('sales.destroy', $sale) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="{{ route('sales.show', $sale) }}"
                                                class="btn btn-outline-primary">Detalle</a>
                                            <a href="{{ route('sale-print-pdf',$sale->id) }}"
                                                class="btn btn-outline-primary">Imprimir</a>
                                             <button type="submit" class="btn btn-outline-primary">Eliminar</button>
                                        </div>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection

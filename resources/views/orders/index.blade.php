@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Lista de pedidos</h1>
    {{-- <a href="{{ route('orders.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Nueva Venta</a> --}}
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
                            <th>Numero</th>
                            <th>Fecha y Hora</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Numero</th>
                            <th>Direccion</th>
                            <th>Total</th>                          
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td><a href="{{ route('orders.show', $order) }}">{{ $order->id }}</a></td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td>{{ $order->user_phone }}</td>
                                <td>{{ $order->user_address }}</td>
                                <td>{{ $order->total }}</td>


                                {{-- @if ($order->status == 'VALID')
                                    <td>
                                        <a href="{{ route('change_status.orders', $order) }}" class="btn btn-outline-success">
                                            Activa<i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('change_status.orders', $order) }}" class="btn btn-outline-danger">
                                            Cancelada<i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                @endif --}}

                                <td>
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="{{ route('orders.show', $order) }}"
                                                class="btn btn-outline-primary">Detalle</a>
                                            {{-- <a href="{{ route('order-print-pdf',$order->id) }}"
                                                class="btn btn-outline-primary">Imprimir</a> --}}
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

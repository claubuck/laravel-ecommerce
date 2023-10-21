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
                <form method="GET" action="{{ route('orders.index') }}">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="search">Buscar:</label>
                            <input type="text" name="search" id="search" class="form-control"
                                value="{{ request('search') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="number">Buscar por N° pedido:</label>
                            <input type="text" name="number" id="number" class="form-control"
                                value="{{ request('number') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="status">Filtrar por estado:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Todos</option>
                                <option value="Nuevo" {{ request('status') == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                                <option value="En preparación"
                                    {{ request('status') == 'En preparación' ? 'selected' : '' }}>En preparación</option>
                                <option value="Enviado" {{ request('status') == 'Enviado' ? 'selected' : '' }}>Enviado
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="submit" class="invisible">Buscar</label>
                            <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                        </div>
                    </div>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Número 
                                <a href="{{ route('orders.index', ['sort' => 'asc']) }}">
                                    <i class="fas fa-arrow-up"></i>
                                </a>
                                <a href="{{ route('orders.index', ['sort' => 'desc']) }}">
                                    <i class="fas fa-arrow-down"></i>
                                </a>
                            </th>
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
                                            <a href="{{ route('order-print-pdf', $order->id) }}"
                                                class="btn btn-outline-primary">Imprimir</a>
                                            <button type="submit" class="btn btn-outline-primary">Eliminar</button>
                                        </div>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

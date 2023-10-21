@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Detalles del pedido</h1>
    <a href="{{ route('order-print-pdf', $sale->order->id) }}"
        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i>Imprimir</a>
@endsection


@section('content')
    <div class="card shadow mb-4">

        <div class="card-body">
            {{-- <h5 class="card-title">Vendedor: {{$sale->user->name}}, {{$sale->user->last_name}} </h5> --}}
            <h5 class="card-title">Fecha de pedido: {{ $sale->sale_date }}</h5>
            <h5 class="card-title">Estado: {{ $sale->order->status }}
                <button type="button" class="ml-4 btn btn-primary" data-toggle="modal" data-target="#cambiarEstadoModal">
                    Cambiar Estado
                </button>
            </h5>
            <h5 class="card-title">Cliente: {{ $sale->order->user_name }}</h5>
            <h5 class="card-title">Telefono: {{ $sale->order->user_phone }}</h5>
            <h5 class="card-title">Direccion: {{ $sale->order->user_address }}</h5>
        </div>


        <div class="card-header py-3">
            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio de venta</th>
                            <th>Descuento</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                <p align ="right">SUB TOTAL</p>
                            </th>
                            <th colspan="4">
                                <p align ="right">{{ number_format($subtotal, 2) }}</p>
                            </th>

                        </tr>
                        <tr>
                            <th colspan="4">
                                <p align ="right">TOTAL IMPUESTO({{ $sale->tax }}%)</p>
                            </th>
                            <th colspan="4">
                                <p align ="right">{{ number_format(($subtotal * $sale->tax) / 100, 2) }}</p>
                            </th>

                        </tr>
                        <tr>
                            <th colspan="4">
                                <p align ="right">TOTAL:</p>
                            </th>
                            <th colspan="4">
                                <p align ="right">{{ number_format($sale->total, 2) }}</p>
                            </th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($saleDetails as $details)
                            <tr>
                                <td><a href="">{{ $details->product->name }}</a></td>
                                <td>{{ $details->price }}</td>
                                <td>{{ $details->discount }}</td>
                                <td>{{ $details->quantity }}</td>
                                <td>{{ number_format($details->quantity * $details->price - $details->discount, 2) }}
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal para cambiar el estado -->
    <div class="modal fade" id="cambiarEstadoModal" tabindex="-1" role="dialog" aria-labelledby="cambiarEstadoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cambiarEstadoModalLabel">Cambiar Estado del Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para cambiar el estado -->
                    <form method="POST" action="{{ route('orders.update', $sale->order->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nuevoEstado">Nuevo Estado:</label>
                            <select class="form-control" id="nuevoEstado" name="nuevoEstado">
                                <option value="Nuevo" @if($sale->order->status == 'Nuevo') selected @endif>Nuevo</option>
                                <option value="En Preparación" @if($sale->order->status == 'En Preparación') selected @endif>En preparación</option>
                                <option value="Enviado" @if($sale->order->status == 'Enviado') selected @endif>Enviado</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

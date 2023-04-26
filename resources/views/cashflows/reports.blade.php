@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Turnos cerrados</h1>
    {{-- <a href="{{route('products.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Nuevo Producto</a> --}}
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
                            <th>Incio de turno</th>
                            <th>Fin de turno</th>
                            <th>Monto inicial de caja</th>
                            <th>Total de ventas del turno</th>
                            <th>Monto final de caja conteo manual</th>
                            {{-- <th>Acciones</th> --}}

                        </tr>
                    </thead>
                    <!--  <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>
                                    
                                </tr>
                            </tfoot> -->
                    <tbody>
                        @if ($cashFlow)
                            @foreach ($cashFlow as $cash)
                                <tr>
                                    <td>{{ $cash->inicio }}</td>
                                    <td>{{ $cash->fin }}</td>
                                    <td>{{ $cash->start }}</td>
                                    <td>{{ $cash->sales }}</td>
                                    <td>{{ $cash->closing_cash }}</td>
                                    {{-- <td>{{ $product->category ? $product->category->name : 'Sin categoría' }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->sell_price }}</td> --}}
                                    {{-- <td>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="{{ route('products.edit', $product) }}"
                                                    class="btn btn-outline-primary">editar</a>
                                                <button type="submit" class="btn btn-outline-primary">Eliminar</button>
                                            </div>
                                        </form>
                                    </td> --}}

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

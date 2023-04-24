@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Productos</h1>
    <a href="{{route('products.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Nuevo Producto</a>
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
                            <th>Code</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Precio</th>
                            <th>Acciones</th>

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
                        @if ($products)
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->code }}</td>
                                    <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->category ? $product->category->name : 'Sin categoría' }}</td>
                                    <td>{{ $product->stock }}</td>

                                    @if ($product->status == 'Activo')
                                        <td>
                                            {{-- <a href="{{ route('change_status.products', $product) }}"
                                                class="btn btn-outline-success">
                                                Activo<i class="fas fa-check"></i>
                                            </a> --}}
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('change_status.products', $product) }}"
                                                class="btn btn-outline-danger">
                                                Inactivo<i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    @endif

                                    <td>{{ $product->sell_price }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="{{ route('products.edit', $product) }}"
                                                    class="btn btn-outline-primary">editar</a>
                                                <button type="submit" class="btn btn-outline-primary">Eliminar</button>
                                            </div>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

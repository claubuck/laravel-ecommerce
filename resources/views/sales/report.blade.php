@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Reportes</h1>
    {{--  <a href="{{ route('sales.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Nueva Venta</a> --}}
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="mostrar-formulario">Reporte
        personalizado</button>
@endsection

@section('content')
    <div id="formulario" style="display: none;">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="fecha_inicio">Fecha inicio</label>
                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha fin</label>
                <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
            </div>
            <button type="submit" class="btn btn-primary">Generar reporte</button>
        </form>
    </div>

    <div class="container">
        <h1>Ventas del turno actual</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha de reporte</th>
                    <th>Pagos en efectivo</th>
                    <th>Pagos con tarjeta</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ Carbon\Carbon::today()->toDateString() }}</td>
                    <td>{{ $totalCash }}</td>
                    <td>{{ $totalCard }}</td>
                    <td>{{ $total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#mostrar-formulario').click(function() {
            if ($('#formulario').is(':visible')) {
                $('#formulario').hide();
            } else {
                $('#formulario').show();
            }
        });
    </script>
@endsection

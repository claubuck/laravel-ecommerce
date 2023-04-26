@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Caja</h1>
    {{-- <a href="{{route('products.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Apertura de Caja</a> --}}
@endsection

@section('content')
    @if ($cashFlow)
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Turno</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h6>Inicio de turno: <span class="text-secondary">{{ $cashFlow->inicio }}</span></h6>
                    </div>
                    <div class="col-sm-6">
                        <h6>Fin de turno: <span class="text-secondary">{{ $cashFlow->fin }}</span></h6>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h6>Valor inicial de caja: <span class="text-secondary">{{ $cashFlow->start }}</span></h6>
                    </div>
                    <div class="col-sm-6">
                        <h6>Monto de ventas del turno: <span class="text-secondary">{{ $sales }}</span></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Balance de dinero incial mas las ventas acumuladas del turno: <span
                                class="text-secondary">{{ $balance }}</span></h6>
                    </div>
                </div>
                <button id="closeCashFlowBtn" class="btn btn-primary">Cerrar caja</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('cash-flow.update', $cashFlow->id) }}" method="POST" id="closeCashFlowForm"
                    style="display:none;">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="number" id="sales" name="sales" step="0.01" value="{{$balance}}" class="form-control"
                            hidden>
                    </div>
                    <div class="form-group">
                        <label for="cash">Dinero en caja:</label>
                        <input type="number" id="closing_cash" name="closing_cash" step="0.01" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Cerrar caja</button>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-success">
            <strong>No hay apertura de caja en curso!</strong> Puedes iniciar un nuevo desde aqui.
            <a href="{{ route('cash-flow.create') }}" class="btn btn-primary">Apertura de Caja</a>
        </div>
    @endif
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#closeCashFlowBtn').click(function() {
                $('#closeCashFlowBtn').hide();
                $('#closeCashFlowForm').show();
            });
        });
    </script>
@endsection

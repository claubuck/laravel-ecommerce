@extends('layouts.layout')

@section('heading_page')

                        <h1 class="h3 mb-0 text-gray-800">Detalles de venta</h1>
                        <a href="{{ route('sale-print-pdf',$sale->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i>Imprimir</a>

                
                        
    
@endsection


@section('content')

<div class="card shadow mb-4">

    <div class="card-body">
        <h5 class="card-title">Vendedor: {{$sale->user->name}}, {{$sale->user->last_name}} </h5>
        <h5 class="card-title">Fecha de Venta: {{$sale->sale_date}}</h5>
      </div>

    
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered"  width="100%" cellspacing="0">
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
                                            <th colspan="4"><p align ="right">SUB TOTAL</p></th>
                                            <th colspan="4"><p align ="right">{{number_format($subtotal,2)}}</p></th>

                                        </tr>
                                        <tr>
                                            <th colspan="4"><p align ="right">TOTAL IMPUESTO({{$sale->tax}}%)</p></th>
                                            <th colspan="4"><p align ="right">{{number_format($subtotal*$sale->tax/100,2)}}</p></th>

                                        </tr>
                                        <tr>
                                            <th colspan="4"><p align ="right">TOTAL:</p></th>
                                            <th colspan="4"><p align ="right">{{number_format($sale->total,2)}}</p></th>

                                        </tr>
                                    </tfoot> 
                                    <tbody>
                                        @foreach ($saleDetails as $details )
                                            
                                        
                                        <tr>
                                            <td><a href="">{{$details->product->name}}</a></td>
                                            <td>{{$details->price}}</td>
                                            <td>{{$details->discount}}</td>
                                            <td>{{$details->quantity}}</td>
                                            <td>{{number_format($details->quantity*$details->price - $details->quantity*$details->price*$details->discount/100,2)}}</td>

                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

  
@endsection
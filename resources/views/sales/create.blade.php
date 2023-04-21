@extends('layouts.layout')

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Ventas</h1>
    <a href="{{ route('sales.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Nueva Venta</a>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf @method('POST')

            {{-- <div class="row">

                <div class="col-4 mb-3 mt-3">
                    <label for="address">Cliente</label>
                    <select class="form-control" name="client_id" id="client_id">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name . ' ' . $client->lastname }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}


            <div class="row">

                <div class="col-2 mb-3 mt-3">
                    <label for="code">Codigo</label>
                    <input type="text" class="form-control" id="code" name="code">
                </div>

                <div class="col-6 mb-3 mt-3">
                    <label for="product_id">Productos</label>
                    <select class="form-control" name="product_id" id="product_id">
                        <option name="option" id="option" value="" disabled selected>Seleccione un producto
                        </option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}_{{ $product->stock }}_{{ $product->sell_price }}">
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 mb-3 mt-3">
                    <label for="stock">Stock Actual del producto</label>
                    <input type="text" class="form-control" id="stock" name="stock" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3 mt-3">
                    <label for="price">Precio de Venta</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
                <div class="col-3 mb-3 mt-3">
                    <label for="quantity">Cantidad</label>
                    <input type="text" class="form-control" id="quantity" name="quantity">
                </div>



                <div class="col-2 mb-3 mt-3">
                    <label for="tax">Impuesto</label>
                    <input type="number" class="form-control" id="tax" name="tax" value="0" placeholder="Opcional">
                </div>
                <div class="col-2 mb-3 mt-3">
                    <label for="discount">Descuento %</label>
                    <input type="text" class="form-control" id="discount" name="discount" value="0" placeholder="Opcional">
                </div>

            </div>
            <button type="button" id="agregar" name="agregar" class="btn btn-primary float-right">Agregar a la
                lista</button>


            <div class="container mt-3">
                <h4 class="card-title">Detalle de venta</h4>

                <table class="table table-striped" id="detalles" align="right">
                    <thead>
                        <tr>
                            <th>Eliminar</th>
                            <th>Producto</th>
                            <th>Precio de venta</th>
                            <th>Descuento</th>
                            <th>Cantidad</th>
                            <th>SubTotal</th>
                        </tr>

                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th>
                                <p aligin="right"><span id="total">$ 0.00</span></p>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <p>Total Impuesto</p>
                            </th>
                            <th>
                                <p aligin="right"><span id="total_impuesto">$ 0.00</span></p>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <p aligin="right">Total a Pagar</p>
                            </th>
                            <th>
                                <p aligin="right"><span aligin="right" id="total_pagar_html">$ 0.00</span>
                                    <input type="hidden" name="total" id="total_pagar">
                                </p>
                            </th>
                        </tr>


                    </tfoot>
                    <tbody>

                    </tbody>
                </table>

                {{-- <div class="row">
                    <div class="col-4 mb-3 mt-3">
                        <label for="pago">Cobro en efectivo</label>
                        <input type="text" class="form-control" id="pago" name="pago">
                    </div>
                    <div class="col-4 mb-3 mt-3">
                        <label for="collect">Saldo a cuenta corriente</label>
                        <input type="text" class="form-control" id="collect" name="collect">
                    </div>

                </div> --}}

            </div>

            <a class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>

        </form>
    </div>

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#agregar").click(function() {
                agregar();
            });
        });


        var cont = 1;
        total = 0;
        subtotal = [];

        $("#guardar").hide();
        $("#product_id").change(mostrarValores);

        function mostrarValores() {
            datosProducto = document.getElementById("product_id").value.split('_');
            $("#price").val(datosProducto[2]);
            $("#stock").val(datosProducto[1]);
        }
        var product_id = $('#product_id')
        product_id.change(function() {
            $.ajax({
                url: "{{ route('get_products_by_id') }}",
                type: 'GET',
                data: {
                    product_id: product_id.val(),
                },
                success: function(data) {
                    $("#price").val(data.sell_price);
                    $("#stock").val(data.stock);
                    $("#code").val(data.code);
                }

            });

        })


        $(obtener_registro());

        function obtener_registro(code) {
            $.ajax({
                url: "{{ route('get_products_by_barcode') }}",
                type: 'GET',
                data: {
                    code: code
                },
                success: function(data) {
                    $("#price").val(data.sell_price);
                    $("#stock").val(data.stock);
                    /* $("#product_id").val(data.stock); */

                    option = document.getElementById("option");
                    option.value = data.id;
                    option.text = data.name;



                }

            });

        }

        $(document).on('keyup', '#code', function() {
            var valorResultado = $(this).val();
            if (valorResultado != "") {
                obtener_registro(valorResultado);

            } else {
                obtener_registro();
            }
        })



        function agregar() {
            datosProducto = document.getElementById("product_id").value.split('_');
            product_id = datosProducto[0];
            producto = $("#product_id option:selected").text();
            quantity = $("#quantity").val();
            discount = $("#discount").val();
            price = $("#price").val();
            stock = $("#stock").val();
            impuesto = $("#tax").val();

            if (product_id != "" && quantity != "" && quantity > 0 && price != "") {
                if (parseInt(stock) >= parseInt(quantity)) {
                    subtotal[cont] = (quantity * price) - (quantity * price * (discount / 100));
                    total = total + subtotal[cont];
                    var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" onclick="eliminar(' +
                        cont +
                        ');" class="btn btn-outline-danger"><i class="fa fa-times"></i></button></td><td><input type="hidden" name="product_id[]" value="' +
                        product_id + '">' + producto + '</td><td><input type="hidden" name="price[]" value="' + parseFloat(
                            price).toFixed(2) + '"><input class="form-control" type="number" value="' + parseFloat(price)
                        .toFixed(2) + '" disabled></td><td><input type="hidden" name="discount[]" value="' + parseFloat(
                            discount) + '"><input class="form-control" type="number" value="' + parseFloat(discount) +
                        '" disabled></td><td><input type="hidden" name="quantity[]" value="' + quantity +
                        '"><input type="number" value="' + quantity +
                        '" class="form-control" disabled></td><td align="right">' + parseFloat(subtotal[cont]).toFixed(2) +
                        '</td></tr>';
                    cont++;
                    limpiar();
                    totales(impuesto);
                    evaluar();
                    $('#detalles').append(fila);
                } else {
                    /* Swal.fire({
                        type: 'error',
                        text: 'No hay mas stock disponible de este producto'
                    }) */
                }
            } else {
                /* Swal.fire({
                        type: 'error',
                        text: 'No hay mas stock disponible de este producto'
                }) */
            }
        }

        function limpiar() {
            $("#quantity").val("");
            $("#discount").val("0");
            $("#price").val("");
        }

        function totales(impuesto) {
            $("#total").html("$" + total.toFixed(2));
            total_impuesto = total * impuesto / 100;
            total_pagar = total + total_impuesto;
            $("#total_impuesto").html("$" + total_impuesto.toFixed(2));
            $("#total_pagar_html").html("$" + total_pagar.toFixed(2));
            $("#total_pagar").val(total_pagar.toFixed(2));
        }

        $("#pago").change(pago);

        function pago() {
            Pagos = $("#pago").val();
            saldo = total_pagar - Pagos;
            $("#collect").val(saldo.toFixed(2));
            $("#collect").css({
                "background-color": "rgb(82,179,126)"
            });
            btnagregar = document.getElementById("agregar")
            btnagregar.disabled = true;


        }

        function evaluar() {
            if (total > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index) {
            total = total - subtotal[index];
            total_impuesto = total * impuesto / 100;
            total_pagar_html = total + total_impuesto;
            $("#total").html("$" + total);
            $("#total_pagar_html").html("$" + total_impuesto);
            $("#total_impuesto").html("$" + total_pagar_html);
            $("#total_pagar").val(total_pagar_html.toFixed(2));
            $("#fila" + index).remove();
            evaluar();
        }
    </script>


@endsection

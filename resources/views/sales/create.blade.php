@extends('layouts.layout')

@section('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('heading_page')
    <h1 class="h3 mb-0 text-gray-800">Registrar venta</h1>
    {{-- <a href="{{ route('sales.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Nueva Venta</a> --}}
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('sales.store') }}" id="payment-form" method="POST">
            @csrf @method('POST')

            <div class="row">

                <div class="col-2 mb-3 mt-3">
                    <label for="code">Codigo</label>
                    <input type="text" class="form-control" id="code" name="code">
                </div>


                <div class="col-6 mb-3 mt-3">
                    <label for="product">Producto</label>
                    <select class="js-example-basic-single form-control" name="product_id" id="product_id">
                    </select>
                </div>

                {{-- <div class="col-6 mb-3 mt-3">
                    <label for="product_id">Productos</label>
                    <input class="form-control" name="product_id" id="product_id" type="text"
                        placeholder="Buscar producto">
                </div> --}}

                {{-- <div class="col-6 mb-3 mt-3">
                    <label for="product_id">Productos</label>
                    <select class="form-control" name="product_id" id="product_id">
                        <option name="option" id="option" value="" disabled selected>Seleccione un producto
                        </option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}_{{ $product->stock }}_{{ $product->sell_price }}">
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
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
                    <input type="number" class="form-control" id="tax" name="tax" value="0"
                        placeholder="Opcional">
                </div>
                <div class="col-2 mb-3 mt-3">
                    <label for="discount">Descuento en &euro;</label>
                    <input type="text" class="form-control" id="discount" name="discount" value="0"
                        placeholder="Opcional">
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
                                <p aligin="right"><span id="total">&euro; 0.00</span></p>
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
                                <p aligin="right"><span id="total_impuesto">&euro; 0.00</span></p>
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
                                <p aligin="right"><span aligin="right" id="total_pagar_html">&euro; 0.00</span>
                                    <input type="hidden" name="total" id="total_pagar">
                                </p>
                            </th>
                        </tr>


                    </tfoot>
                    <tbody>

                    </tbody>
                </table>

                <div class="form-group text-center">
                    <label for="payment">Forma de pago:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_type" id="payment_cash" value="cash_pay">
                        <label class="form-check-label" for="payment_cash">Efectivo</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_type" id="payment_card" value="card_pay">
                        <label class="form-check-label" for="payment_card">Tarjeta</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4 mb-3 mt-3">
                        
                        <input type="hidden" class="form-control" id="efec" name="efec">
                    </div>
                    <div class="col-4 mb-3 mt-3">
                        
                        <input type="hidden" class="form-control" id="card" name="card">
                    </div>
                </div>


            </div>

            <a class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
            <button type="submit" id="save-button" class="btn btn-primary">Guardar</button>

        </form>
    </div>
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        // Inicializar el plugin Select2 en el campo de entrada de texto
        $('#product_id').select2({
            minimumInputLength: 3, // El usuario debe escribir al menos 3 caracteres antes de buscar
            ajax: {
                url: "{{ route('get_products_by_id') }}", // URL del endpoint del servidor para buscar productos
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term // El término de búsqueda del usuario
                    };
                },
                processResults: function(data) {
                    // Convertir los datos recibidos del servidor en el formato esperado por Select2
                    var results = $.map(data, function(product) {
                        return {
                            id: product.id,
                            text: product.name,
                            stock: product.stock,
                            price: product.sell_price
                        };
                    });

                    return {
                        results: results
                    };
                }
            }
        });

        // Mostrar el precio y el stock del producto seleccionado en campos de texto separados
        $('#product_id').on('select2:select', function(e) {
            var data = e.params.data;
            $('#price').val(data.price);
            $('#stock').val(data.stock);
        });



        /* $("#product_id").change(mostrarValores);

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

        }) */


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
                    /* option.value = data.id; */
                    /* option.text = data.name; */



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
                    subtotal[cont] = (quantity * price) - discount;
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

        //------------------Selecciona metodo de pago
        // Añadimos un evento al cambio de selección del radio button
        $('input[type=radio][name=payment_type]').change(function() {
            // Si el radio button seleccionado es el de efectivo
            if (this.value == 'cash_pay') {
                $('#efec').val(total_pagar.toFixed(2));
            // Borramos el valor del campo card
            $('#card').val('');
            }
            // Si el radio button seleccionado es el de tarjeta
            else if (this.value == 'card_pay') {
                $('#card').val(total_pagar.toFixed(2));
            // Borramos el valor del campo cash
            $('#efec').val('');
      
            }
        });
        //----------------------------

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

        //validaciones 

        $('#save-button').click(function(e) {
        e.preventDefault();
        
        // Comprobar si alguno de los dos radio buttons está seleccionado
        if (!$('#payment_cash').is(':checked') && !$('#payment_card').is(':checked')) {
            alert('Debes seleccionar al menos una opción de pago');
            return;
        }
        
        // Si al menos uno de los radio buttons está seleccionado, enviar el formulario
        $('#payment-form').submit();
    });
    </script>
@endsection

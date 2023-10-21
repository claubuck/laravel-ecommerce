<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        h1 {
            margin-top: 0;
        }

        /* Create three equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 4px;
            height: auto;
            /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>
    <h1>Detalles de pedido</h1>
    <p style="text-align: right; border-bottom: 1px solid #000;"><strong>Número de Pedido:</strong>
        {{ str_pad($sale->order->id, 8, '0', STR_PAD_LEFT) }}</p>         
    <div class="row">
        <div class="column">
            <h2>Cliente</h2>
            <p><strong>Cliente:</strong> {{ $sale->order->user_name }}</p> 
            <p><strong>Telefono:</strong> {{ $sale->order->user_phone }}</p>
            <p><strong>Direccion:</strong> {{ $sale->order->user_address }}</p>
        </div>
        <div class="column">
            <h2>Pedido</h2>
            <p><strong>Estado:</strong> {{ $sale->order->status }}</p>
            <p><strong>Fecha:</strong> {{ $sale->order->created_at }}</p>
            <p><strong>Total:</strong> {{ $sale->total }}</p> 
        </div>

    </div>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Descuento</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->saleDetails as $details)
                <tr>
                    <td>{{ $details->product->name }}</td>
                    <td>{{ $details->price }}</td>
                    <td>{{ $details->quantity }}</td>
                    <td>{{ $details->discount }}</td>
                    <td>{{ number_format($details->quantity * $details->price - $details->discount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
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
    </table>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Venta</title>
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
    </style>
</head>

<body>
    <h1>Detalles de la venta</h1>
	<p><strong>Vendedor:</strong> {{$sale->user->name}}, {{$sale->user->last_name}}</p>
    <p><strong>Fecha:</strong> {{ $sale->sale_date }}</p>
    <p><strong>Total:</strong> {{ $sale->total }}</p>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->saleDetails as $details)
                <tr>
                    <td>{{ $details->product->name }}</td>
                    <td>{{ $details->price }}</td>
                    <td>{{ $details->discount }}%</td>
                    <td>{{ $details->quantity }}</td>
                    <td>{{ number_format($details->quantity * $details->price - ($details->quantity * $details->price * $details->discount) / 100, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
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
    </table>
</body>

</html>

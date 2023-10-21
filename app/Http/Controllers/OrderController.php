<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\saleDetail;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::query();

        // Filtrar por estado si se proporciona un estado en la solicitud
        if ($request->has('status') && $request->input('status') != null) {
            $status = $request->input('status');
            $orders->where('status', $status);
        }

        // Realizar la búsqueda si se proporciona un término de búsqueda
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $orders->where('user_name', 'like', '%' . $searchTerm . '%');
        }

        // Realizar la búsqueda si se proporciona un término de búsqueda
        if ($request->has('number')) {
            $searchNum = $request->input('number');
            $orders->where('id', 'like', '%' . $searchNum . '%');
        }

        // Ordenar según el parámetro 'sort'
        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort == 'asc') {
                $orders->orderBy('id', 'asc');
            } elseif ($sort == 'desc') {
                $orders->orderBy('id', 'desc');
            }
        } else {
            // Ordenar de forma predeterminada (puedes cambiar esto)
            $orders->orderBy('id', 'asc');
        }

        $orders = $orders->paginate(10); // Paginar los resultados

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $sale = $order->sale;
        $subtotal = 0;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price -
                $saleDetail->discount;
        }


        return view('orders.show', compact('sale', 'saleDetails', 'subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        // Actualizar el estado del pedido
        $nuevoEstado = $request->input('nuevoEstado');
        $order->status = $nuevoEstado;
        $order->save();

        // Redireccionar de regreso con un mensaje de éxito
        return redirect()->back()->with('success', 'Estado del pedido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $sale = $order->sale()->first();
        $detallesVenta = saleDetail::where('sale_id', $sale->id)->get();

        foreach ($detallesVenta as $detalle) {
            $producto = Product::find($detalle->product_id);
            $producto->stock += $detalle->quantity;
            $producto->save();
        }
        saleDetail::where('sale_id', $sale->id)->delete();
        $sale->delete();
        $order->delete();
        return redirect('/orders')->with('success', 'El pedido a sido eliminado y los productos han sido devueltos al stock.');
    }

    public function generatePdf(Order $order)
    {
        $sale = $order->sale;
        $subtotal = 0;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price -
                $saleDetail->discount;
        }

        $pdf = new Dompdf();
        $view = View::make('orders.order_pdf', compact('sale', 'saleDetails', 'subtotal'))->render();
        $pdf->loadHtml($view);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('pedido_' . $order->id . '.pdf');
    }
}

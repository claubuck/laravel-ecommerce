<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\cashFlow;
use App\Models\Product;
use App\Models\saleDetail;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashFlow = cashFlow::where('closed', '<>', 1)->first();
        if ($cashFlow) {
            $inicio = $cashFlow->inicio;
        $fin = $cashFlow->fin;

        $sales = Sale::whereBetween('created_at', [$inicio, $fin])->get();}else{
            $sales=[];
        }

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $products = Product::get();
        return view('sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        /*  return $request; */
        $user = Auth::user();
        $sale = $user->sales()->create([
            'total' => $request->input('total'),
            'cash' => $request->input('cash'),
            'card' => $request->input('card'),
            'sale_date' => Carbon::now(),
        ]);


        $saleDetails = [];
        foreach ($request->product_id as $key => $product) {

            $product = Product::findOrFail($request->product_id[$key]);

            $saleDetail = new saleDetail([
                "quantity" => $request->quantity[$key],
                "price" => $request->price[$key],
                "discount" => $request->discount[$key],
            ]);
            $saleDetail->product()->associate($product);
            $saleDetails[] = $saleDetail;
        }
        $sale->saleDetails()->saveMany($saleDetails);

        // Descontar el stock de cada producto vendido
        foreach ($saleDetails as $saleDetail) {
            $product = $saleDetail->product;
            $product->stock -= $saleDetail->quantity;
            $product->save();
        }

        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $subtotal = 0;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price -
                $saleDetail->discount;
        }


        return view('sales.show', compact('sale', 'saleDetails', 'subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $detallesVenta = saleDetail::where('sale_id', $sale->id)->get();

        foreach ($detallesVenta as $detalle) {
            $producto = Product::find($detalle->product_id);
            $producto->stock += $detalle->quantity;
            $producto->save();
        }
        saleDetail::where('sale_id', $sale->id)->delete();
        $sale->delete();
        return redirect('/sales')->with('success', 'La venta ha sido eliminada y los productos han sido devueltos al stock.');
    }

    public function print(Sale $sale)
    {
        //
    }

    public function report()
    {
        $cashFlow = cashFlow::where('closed', '<>', 1)->first();
        if ($cashFlow) {
            $inicio = $cashFlow->inicio;
        $fin = $cashFlow->fin;

        $sales = Sale::whereBetween('created_at', [$inicio, $fin])->get();
        $totalCash = $sales->sum('cash');
        $totalCard = $sales->sum('card');
        $total = $totalCash + $totalCard;
    }else{
        $sales=[];
        
        $totalCash = 0;
        $totalCard = 0;
        $total = $totalCash + $totalCard;
        }
        return view('sales.report', compact('sales', 'totalCash', 'totalCard', 'total'));
    }

    public function generatePdf($id)
    {
        $sale = Sale::findOrFail($id);
        $subtotal = 0;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price -
                $saleDetail->discount;
        }


        $pdf = new Dompdf();
        $view = View::make('sales.sales', compact('sale', 'saleDetails', 'subtotal'))->render();
        $pdf->loadHtml($view);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('venta.pdf');
    }
}

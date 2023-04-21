<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
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
        $sales = Sale::get();
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
        $user = Auth::user();
        $sale = $user->sales()->create([
            'total' => $request->input('total'),
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
                $saleDetail->quantity * $saleDetail->price * $saleDetail->discount / 100;
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
        //
    }

    public function print(Sale $sale)
    {
        //
    }

    public function generatePdf($id)
    {
        $sale = Sale::findOrFail($id);
        $subtotal = 0;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price -
                $saleDetail->quantity * $saleDetail->price * $saleDetail->discount / 100;
        }


        $pdf = new Dompdf();
        $view = View::make('sales.sales', compact('sale', 'saleDetails', 'subtotal'))->render();
        $pdf->loadHtml($view);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('venta.pdf');
    }
}

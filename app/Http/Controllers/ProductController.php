<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'sell_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image',
        ]);

        $product = new Product;
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->sell_price = $validatedData['sell_price'];
        $product->stock = $validatedData['stock'];
        $product->image = $validatedData['image']->store('products', 'public');
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function get_products_by_barcode(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('code', $request->code)->firstOrFail();
            return response()->json($products);
        }
    }

    public function get_products_by_id(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('name', 'LIKE', '%' . $query . '%')->get();

        return response()->json($products);
        /* if($request->ajax()){
            $products = Product::findOrFail($request->product_id);
            return response()->json($products);
        } */
    }
}

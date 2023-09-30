<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('products.create', compact('categories'));
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
            'category_id' => 'required',
        ]);

        $product = new Product;
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->sell_price = $validatedData['sell_price'];
        $product->stock = $validatedData['stock'];
        $product->image = $validatedData['image']->store('products', 'public');
        $product->category_id = $validatedData['category_id'];
        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto creado');
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
        $categories = Category::get();
        return view('products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->sell_price = $request->input('sell_price');
    $product->stock = $request->input('stock');
    $product->category_id = $request->input('category_id');

    /* if ($request->hasFile('image')) {
        // elimina la imagen existente si el usuario carga una nueva
        if ($product->image) {
            Storage::delete($product->image);
        }
        $path = $request->file('image')->store('public/products');
        $product->image = $path;
    } */
    if ($request->hasFile('image')) {
        // elimina la imagen existente si el usuario carga una nueva
        if ($product->image) {
            Storage::delete($product->image);
        }
        $path = $request->file('image')->store('products', 'public');
        $product->image = $path;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Producto eliminado');

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

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\saleDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShopingCardController extends Controller
{
    public function shopingCard()
    {
        //$productos = Category::with('products')->get();
        
        $productos = Product::get();
        return response()->json($productos);
    }

    public function storeShopingCard(Request $request)
    { 
        $user = User::findOrFail(1);
        $sale = $user->sales()->create([
            'type' => 'Pedido',
            'total' => $request->total,
            'cash' => 0,
            'card' => $request->total,
            'sale_date' => Carbon::now(),
        ]);

        $saleDetails = [];
        foreach ($request->detalles as $detalle) {
            // Accede a las propiedades del objeto
            $product = Product::findOrFail($detalle['id']);
            $quantity = $detalle['quantity'];
    
            $saleDetail = new saleDetail([
                "quantity" => $quantity,
                "price" => $product->sell_price,
                "discount" => 0,
            ]);
            $saleDetail->product()->associate($product);
            $saleDetails[] = $saleDetail;
        }
        $sale->saleDetails()->saveMany($saleDetails); 
         //Guardar pedido
        $sale->order()->create([
            'user_name' => $request->pedido[0]['nombre'],
            'user_email' => '',
            'user_phone' => $request->pedido[0]['telefono'],
            'user_address' => $request->pedido[0]['direccion'],
            'user_city' => '',
            'sale_id' => 1,
            'status' => 'Nuevo',
            'total' => $request->total,
            'paid' => false,
        ]);

        // Descontar el stock de cada producto vendido
        foreach ($saleDetails as $saleDetail) {
            $product = $saleDetail->product;
            $product->stock -= $saleDetail->quantity;
            $product->save();
        }

        return response()->json($request->detalles);

    }
}

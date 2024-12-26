<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('cartItem', 'cartItem.product')->where('user_id', Auth::user()->id)->first();

        if (!$carts) {
            Cart::create([
                'user_id'   => Auth::user()->id,
                'total'     => 0,
            ]);
        }

        return view("pos.cart", [
            'carts' => $carts
        ]);
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
    public function store(Request $request)
    {
        $productId  = $request->product_id;
        $product    = Product::where('id', $productId)->first();
        $cart       = Cart::where('user_id', Auth::user()->id)->first();

        if ($product->qty == 0) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Stok Produk Habis'
            ], 400);
        }

        if (!$cart) {
            Cart::create([
                'user_id'   => Auth::user()->id,
                'total'     => 0,
            ]);
            return $this->store($request);
        }

        $existItem = CartItem::where([
            'cart_id'       => $cart->id,
            'product_id'    => $productId,
        ])->first();

        if (!$existItem) {
            CartItem::create([
                'cart_id'       => $cart->id,
                'product_id'    => $productId,
                'quantity'      => 1
            ]);
        } else {
            $existItem->quantity += 1;
            $existItem->save();
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'Product Berhasil Ditambahkan ke Keranjang'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

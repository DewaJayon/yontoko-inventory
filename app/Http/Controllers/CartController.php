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
        } else {
            $this->calculateTotal($carts);
        }

        return view("pos.cart", [
            'carts' => $carts
        ]);
    }

    private function calculateTotal(Cart $cart)
    {
        $total = 0;

        if (count($cart->cartItem) > 0) {
            foreach ($cart->cartItem as $item) {
                $total += $item->product->price * $item->quantity;
            }
        };

        $cart->update([
            'total' => $total
        ]);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        CartItem::destroy($id);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Item Berhasil Dihapus'
        ], 200);
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart->cartItem()->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Keranjang Berhasil Dihapus'
        ], 200);
    }

    public function storeQty(Request $request)
    {

        $cartItem = CartItem::where([
            'id'       => $request->id,
        ])->first();

        if ($request->quantity > $cartItem->product->qty) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Stok Produk tidak mencukupi'
            ], 400);
        }

        if ($request->quantity == 1) {
            $cartItem->quantity += $request->quantity;
        } else {
            $cartItem->quantity = $request->quantity;
        }

        $cartItem->save();
    }

    public function destroyQty(Request $request)
    {

        $cartItem = CartItem::where([
            'id'       => $request->id,
        ])->first();

        $cartItem->quantity -= $request->quantity;

        if ($cartItem->quantity < 1) {
            $this->destroy($request->id);
        }
        $cartItem->save();
    }
}

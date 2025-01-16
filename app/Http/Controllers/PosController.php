<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();

        if ($request->search != null || $request->search != "") {
            return $this->search($request);
        }

        $products = Product::with("category")->paginate(12);

        return view("pos.index", [
            "title"     => "POS System",
            "products"  => $products
        ]);
    }

    public function search(Request $request)
    {
        $products = Product::where("name", "like", "%$request->search%")->get();

        return view("pos.search", [
            "title"     => "POS System",
            "products"  => $products
        ]);
    }

    public function checkout()
    {
        $carts = Cart::with(['cartItem', 'cartItem.product'])->where('user_id', Auth::user()->id)->firstOrFail();

        return view("pos.modal-checkout", [
            'carts' => $carts
        ]);
    }

    public function order(Request $request)
    {
        $carts = Cart::with(['cartItem', 'cartItem.product'])->where('user_id', Auth::user()->id)->firstOrFail();

        try {
            DB::beginTransaction();

            $orderDate  = date('Y-m-d H:i:s');

            $orderParams = [
                'customer_name'     => $request->customer_name,
                'customer_phone'    => $request->customer_phone,
                'customer_address'  => $request->customer_address,
                'code'              => Order::generateOrderCode(),
                'payment_method'    => "Cash",
                'payment_status'    => "Success",
                'base_total'        => $carts->total,
                'tax_total'         => $carts->calculateTax($carts->total),
                'total'             => $carts->total + $carts->calculateTax($carts->total),
                'order_date'        => $orderDate,
            ];

            $order = Order::create($orderParams);

            if ($order) {

                foreach ($carts->cartItem as $cartItem) {

                    $total = $cartItem->product->price * $cartItem->quantity;

                    $orderItemParams = [
                        'order_id'      => $order->id,
                        'product_id'    => $cartItem->product_id,
                        'quantity'      => $cartItem->quantity,
                        'price'         => $cartItem->product->price,
                        'total'         => $total,
                        'name'          => $cartItem->product->name,
                    ];

                    $orderItem = OrderItem::create($orderItemParams);

                    if ($orderItem) {
                        Product::reduceStock($orderItem->product_id,  $orderItem->quantity);
                    }
                }
            }

            $carts->cartItem()->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return redirect()->route("pos.index")->with("success", "Order berhasil di tambahkan!");
    }
}

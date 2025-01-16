<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderItem', 'orderItem.product'])->get();

        return view('order.index', [
            'title' => 'Order',
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        $orderItems = $order->load(['orderItem', 'orderItem.product']);

        return view('order.show', [
            'title'         => 'Order Detail',
            'order'         => $order,
            'orderItems'    => $orderItems
        ]);
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return redirect()->route('order.index')->with('success', 'Order berhasil di hapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}

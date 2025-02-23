<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $stockAlert = Product::whereColumn('qty', '<=', 'stock_alert')->count();

        return view('dashboard.index', [
            'title'         => 'Dashboard',
            'orders'        => Order::all(),
            'stockAlert'    => $stockAlert
        ]);
    }
}

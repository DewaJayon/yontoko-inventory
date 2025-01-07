<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();

        if ($request->search) {
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
}

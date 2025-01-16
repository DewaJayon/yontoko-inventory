<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("product.index", [
            'title'     => 'Product',
            'products'  => Product::with("category")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create', [
            'title'         => 'Create Product',
            'categories'    => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif',
            'name'          => 'required|max:255',
            'category_id'   => 'required',
            'description'   => 'required',
            'code'          => 'required',
            'qty'           => 'required|numeric',
            'price'         => 'required|numeric',
            'stock_alert'   => 'required|numeric',
        ]);

        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);

        if ($request->hasFile('image')) {

            $image      = $request->file('image');
            $imageName  = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('products');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $image->move($imagePath, $imageName);
        }

        $status = $request->status == 'on' ? 1 : 0;

        $params = [
            'image'         => 'products/' . $imageName,
            'name'          => $request->name,
            'slug'          => $slug,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'code'          => $request->code,
            'status'        => $status,
            'qty'           => $request->qty,
            'price'         => $request->price,
            'stock_alert'   => $request->stock_alert,
        ];

        Product::create($params);

        return redirect()->route('product.index')->with('success', 'Product berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'status' => 'success',
            'product' => $product
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'title'         => $product->title,
            'product'       => $product,
            'categories'    => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'name'          => 'required|max:255',
            'category_id'   => 'required',
            'description'   => 'required',
            'code'          => 'required|max:255',
            'stock_alert'   => 'required|numeric',
            'price'         => 'required|numeric',
            'qty'           => 'required|numeric',
        ]);

        if ($validate['name'] != $product->name) {
            $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        };

        if ($request->hasFile('image')) {

            if ($request->old_image) {
                Storage::delete($request->old_image);
            }

            $image      = $request->file('image');
            $imageName  = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('products');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $image->move($imagePath, $imageName);
        }

        $status = $request->status == 'on' ? 1 : 0;

        $params = [
            'image'         => $request->file('image') ? 'products/' . $imageName : $product->image,
            'name'          => $request->name,
            'slug'          => $slug ?? $product->slug,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'code'          => $request->code,
            'status'        => $status,
            'qty'           => $request->qty,
            'price'         => $request->price,
            'stock_alert'   => $request->stock_alert,
        ];

        Product::where('id', $product->id)->update($params);

        return redirect()->route('product.index')->with('success', 'Product berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            Product::destroy($product->id);
            if ($product->image) {
                Storage::delete($product->image);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Product gagal di hapus!");
        }

        return redirect()->route("product.index")->with("success", "Product berhasil di hapus!");
    }
}

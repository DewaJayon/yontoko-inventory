<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("category.index", [
            "title"         => "Category",
            "categories"    => Category::all()
        ]);
    }

    public function table()
    {
        return view("category.table", [
            'categories' => Category::all()
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
        $validate = $request->validate([
            'name' => 'required|max:255',
        ]);

        $validate['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);

        try {

            Category::create($validate);

            return response()->json([
                'status' => 'success',
                'message' => 'Category berhasil dibuat!'
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'error',
                'message' => 'Category gagal dibuat!'
            ], 500);
        }
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
        $category = Category::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
        ]);

        if ($validate['name'] != Category::findOrFail($id)->name) {
            $validate['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        }

        Category::where('id', $id)->update($validate);

        return response()->json([
            'status' => 'success',
            'message' => 'Category berhasil di update!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Category::findOrFail($id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category berhasil di hapus!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category gagal di hapus!'
            ], 500);
        }
    }
}

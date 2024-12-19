<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::all(),
            'title' => 'List Users'
        ]);
    }

    public function table()
    {
        return view('users.table', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|min:8|max:255',
        ]);

        if ($request->file('photo')) {

            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $photo = $request->file('photo');

            $photoName = time() . '-' . $photo->getClientOriginalName() . '.' . $photo->getClientOriginalExtension();

            $photoPath = Storage::path('users/' . $photoName);

            if (!file_exists($photoPath)) {
                mkdir($photoPath, 0777, true);
            }

            $photo->move($photoPath, $photoName);

            $data['photo'] = $photoName;
        }

        $password = Hash::make($data['password']);

        $data['password'] = $password;

        $data['role'] = $request->role;

        try {

            User::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'User Berhasil Ditambahkan!'

            ]);
        } catch (Exception $e) {
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::findOrFail($id);

        return view('users.update', [
            'data' => $data
        ]);
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
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ];

        $data = $request->validate($rules);

        if ($request->file('photo')) {

            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $photo = $request->file('photo');

            $photoName = time() . '-' . $photo->getClientOriginalName() . '.' . $photo->getClientOriginalExtension();

            $photoPath = Storage::path('users/' . $photoName);

            if (!file_exists($photoPath)) {
                mkdir($photoPath, 0777, true);
            }

            $photo->move($photoPath, $photoName);

            $data['photo'] = $photoName;
        }

        $data['role'] = $request->role;

        try {

            User::where('id', $id)->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'User Berhasil Diupdate!'

            ]);
        } catch (Exception $e) {
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::where('id', $id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User Berhasil Dihapus!'
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'User Gagal Dihapus!'
            ], 500);
        }
    }
}

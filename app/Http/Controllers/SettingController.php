<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index', [
            'title' => 'Setting'
        ]);
    }

    public function changePhoto(Request $request)
    {
        dd($request->toArray());
    }
}

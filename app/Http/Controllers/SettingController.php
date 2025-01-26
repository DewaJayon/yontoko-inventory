<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $request->validate([
            'photo' => 'required',
        ]);

        if ($request->old_photo) {
            Storage::delete($request->old_photo);
        }

        $folderPath = 'profiles/' . str_replace(' ', '-', strtolower(Auth::user()->name)) . '/';

        $storagePath = Storage::path($folderPath);

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        $imageParts     = explode(";base64,", $request->photo);
        $imageTypeAux   = explode("image/", $imageParts[0]);
        $imageType      = $imageTypeAux[1];
        $imageBase64    = base64_decode($imageParts[1]);

        $imageName = time() . '.' . $imageType;

        Storage::put($folderPath . $imageName, $imageBase64);

        User::where('id', Auth::user()->id)->update([
            'photo' => $folderPath . $imageName
        ]);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Foto Berhasil Diubah',
            'photo'     => 'storage/' . $folderPath . $imageName
        ]);
    }
}

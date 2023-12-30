<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function doProses(Request $request)
    {
        if ($request->has('btnInsert')) {
            $code = Hotels::all()->count() + 1;
            $formattedCode = 'H' . str_pad($code, 3, '0', STR_PAD_LEFT);
            $result = Hotels::create([
                "code" => $formattedCode,
                "city_code" => $request->city_code,
                "name" => $request->name,
                "address" => $request->address,
            ]);
            if ($result) {
                return back()->with('pesan', 'sukses');
            } else {
                return back()->with('pesan', 'gagal');
            }
        } else if ($request->has('btnUpdate')) {
            $item = Hotels::find($request->code);
            $result = $item->update([
                "name" => $request->name,
                "city_code" => $request->city_code,
                "address" => $request->address,
                "status" => $request->status,
            ]);
            return back()->with('pesan, sukses');
        }
    }

    public function doDelete(Request $request)
    {
        $item = Hotels::withTrashed()->find($request->code);
        $item->trashed() == true ? $item->restore() : $item->delete();
        return back()->with('pesan, sukses');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function doProses(Request $request)
    {
        if ($request->has('btnInsert')) {
            $result = Hotels::create($request->all());
            if ($result) {
                return back()->with('pesan', 'sukses');
            } else {
                return back()->with('pesan', 'gagal');
            }
        } else if ($request->has('btnUpdate')) {
            $item = Hotels::find($request->code);
            $result = $item->update([
                "name" => $request->name,
                "address" => $request->address,
                "img" =>  $request->img,
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

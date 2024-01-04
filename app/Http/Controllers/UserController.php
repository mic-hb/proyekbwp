<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    public function getLogout(Request $request)
    {
        Auth::guard('User')->logout();
        return true;
    }

    public function postLogin(Request $request)
    {
        /*
        *   JANGAN LUPA KE FILE app/Http/Kernel.php
        *   CTRL + P -> Kernel.php
        *   Ke line 37, di uncomment : \App\Http\Middleware\VerifyCsrfToken::class,
        *   Supoya bisa pakai CSRF Token
        *
        *   Kalau mau testing pake POSTMAN di comment aja
        */

        // TODO: Validasi email tidak boleh kembar

        // Ini validasi tapi ada semacam IF atau conditional
        $request->validate([
            'email' => Rule::when(
                $request->email == 'admin',     // Kalau inputan email == 'admin'
                '',                             // Maka gak perlu ada validasi apa-apa
                'required|email'                // Elsenya, kalau ada validasi ini
            ),
            'password' => Rule::when(
                $request->password == 'admin' || $request->password == '123',
                '',
                'required|alpha_num|min:8'
            ),
            'email' => 'required',
            'password' => 'required'
        ]);


        // return 'Selesai validasi';
        // return $request->all();

        // TODO: Lanjutin login pake AUTH

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard("User")->attempt($credential)) {
            return Auth::guard("User")->user();
        } else {
            return 0;
        }
    }

    public function postRegister(Request $request)
    {
        try {
            // $request->validate([
            //     'name' => 'required|alpha_num|min:3',
            //     'email' => 'required|email|unique:users',
            //     'password' => 'required|alpha_num|min:8|confirmed'
            // ]);

            $request->validate([
                'name' => 'required|alpha_num',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|alpha_num|min:8|confirmed',
                'phone' => 'required'
            ]);

            $code = Users::all()->count() + 1;
            $formattedCode = 'U' . str_pad($code, 3, '0', STR_PAD_LEFT);

            $user = new Users();
            $user->id = $formattedCode;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->phone = $request->input('phone');
            $user->role = 1;
            $user->save();

            // return redirect()->route('login-page')->with('success', 'You have been registered successfully');
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

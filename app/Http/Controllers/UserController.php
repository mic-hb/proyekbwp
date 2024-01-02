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
    public function getLoginPage(Request $request)
    {
        return Inertia::render('entry.login');
    }

    public function getRegisterPage(Request $request)
    {
        return Inertia::render('entry.register');
    }

    public function getLogout(Request $request)
    {
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


        // Ini validasi tapi ada semacam IF atau conditional
        $request->validate([
            'email' => Rule::when(
                $request->email == 'admin',     // Kalau inputan email == 'admin'
                '',                             // Maka gak perlu ada validasi apa-apa
                'required|email'                // Elsenya, kalau ada validasi ini
            ),
            'password' => Rule::when(
                $request->email == 'admin',
                '',
                'required|alpha_num|min:8'
            )
        ]);

        return 'Selesai validasi';

        // TODO: Lanjutin login pake AUTH

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::guard("User")->attempt($credential)) {
            return true;
        } else {
            return false;
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

            $user = new Users();
            $code = Users::all()->count() + 1;
            $formattedCode = 'U' . str_pad($code, 3, '0', STR_PAD_LEFT);
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

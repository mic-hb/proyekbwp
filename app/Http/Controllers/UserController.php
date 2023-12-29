<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

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

        $credentials = $request->only('email', 'password');

        // if (auth()->attempt($credentials)) {
        //     return redirect()->route('home-page');
        // }

        // return redirect()->back()->with('error', 'Invalid credentials');

        if (auth()->attempt($credentials)) {
            return "Login berhasil";
        }

        return "Login gagal";
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha_num|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_num|min:8|confirmed'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->password = bcrypt($request->input('password'));

        $user->save();

        return redirect()->route('login-page')->with('success', 'You have been registered successfully');
    }
}

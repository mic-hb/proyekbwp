<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getLoginPage(Request $request)
    {
        return view('entry.login');
    }

    public function getRegisterPage(Request $request)
    {
        return view('entry.register');
    }

    public function getLogout(Request $request)
    {
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('home-page');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
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

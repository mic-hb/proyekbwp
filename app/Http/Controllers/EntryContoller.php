<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryContoller extends Controller
{
    public function getLoginPage()
    {
        return view('entry.login');
    }

    public function getRegisterPage()
    {
        return view('entry.register');
    }
}

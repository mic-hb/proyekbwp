@extends('templates.home-template')

@section('home-navbar')
    <div class="flex w-1/2 ">
        <h1 class="">DuoVago</h1>
    </div>

    <div class="flex w-1/2">
        <ul class="flex w-full">
            <li class="px-3 py-2 underline underline-offset-2 rounded-md mr-3">
                <a href="{{ route('home-page') }}">Home</a>
            </li>
            <li class="px-3 py-2 rounded-md mr-3">
                <a href="">About</a>
            </li>
            <li class="px-3 py-2 rounded-md mr-3">
                <a href="">Contact</a>
            </li>
            <li class="px-3 py-2 rounded-md mr-3">
                <a href="{{ route('login-page') }}">Login</a>
            </li>
            <li class="px-3 py-2 bg-blue-400 rounded-md mr-3">
                <a href="{{ route('register-page') }}">Register</a>
            </li>
        </ul>
    </div>
@endsection

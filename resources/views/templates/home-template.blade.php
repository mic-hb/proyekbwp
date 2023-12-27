@extends('templates.main-template')

@push('scripts')
@endpush

@section('content')
    <div class="w-full flex flex-col">
        @yield('home-navbar')
        <div class="max-w-screen-xl px-4 py-8 container mx-auto">
            @yield('home-content')
        </div>

    </div>
@endsection

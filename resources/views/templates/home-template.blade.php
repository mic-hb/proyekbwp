@extends('templates.main-template')

@push('scripts')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
    <div class="flex flex-col">
        <div class="flex w-full bg-red-500 gap-2">
            <div class="cotainer mx-auto">
                <div class="flex w-full gap-2 p-4 text-center items-center">
                    @yield('home-navbar')
                </div>
            </div>
        </div>
        <div class="container mx-auto">
            <div class="flex w-full bg-neutral-400">
                @yield('home-content')
            </div>
        </div>
    </div>
@endsection

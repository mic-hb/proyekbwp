@extends('templates.main-template')

@push('scripts')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
    <section class="gradient-form min-h-screen bg-neutral-200 dark:bg-neutral-700">
        <div class="container mx-auto h-full p-10">
            @yield('entry-content')
        </div>
    </section>
@endsection

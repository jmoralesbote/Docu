<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'DocuControl Escolar') }}</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/animate/animate.min.css') }}">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
    @yield('styles')
</head>
<body class="bg-gray-900 text-white font-rubik min-h-screen flex">

    {{-- Sidebar --}}
    @include('layouts.parciales.sidebar')

    {{-- Contenido principal --}}
    <div class="flex-1 flex flex-col">
        {{-- Navbar --}}
        @include('layouts.parciales.navbar')

        {{-- Contenido dinámico --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('layouts.parciales.footer')
    </div>

    @livewireScripts
    @yield('scripts')
</body>
</html>

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

    {{-- Sidebar Drawer ÚNICO --}}
    <div id="sidebar-drawer"
        class="absolute md:fixed top-0 left-0 h-screen w-64 bg-gray-800 z-40 transform -translate-x-full transition-transform duration-300 md:translate-x-0 md:static md:block">
        @include('layouts.parciales.sidebar')
    </div>
    {{-- Backdrop para móvil --}}
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-40 z-30 hidden md:hidden"></div>

    {{-- Contenido principal --}}
    <div class="flex-1 flex flex-col min-w-0 md:ml-64">
        {{-- Navbar --}}
        @include('layouts.parciales.navbar')

        {{-- Contenido dinámico --}}
        <main class="flex-1 p-6 min-w-0">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('layouts.parciales.footer')
    </div>

    @livewireScripts
    @yield('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar-drawer');
        const backdrop = document.getElementById('sidebar-backdrop');
        const btnToggle = document.getElementById('btn-sidebar-toggle');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
        }
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        }

        if (btnToggle) {
            btnToggle.addEventListener('click', openSidebar);
        }
        if (backdrop) {
            backdrop.addEventListener('click', closeSidebar);
        }

        // Cierra el sidebar si el tamaño de pantalla cambia a md o más
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    });
    </script>
</body>
</html>

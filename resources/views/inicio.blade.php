@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-bold text-purple-400 mb-6">📚 Bienvenido a DocuControl</h1>

    {{-- Cards de resumen --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gray-800 p-5 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-white mb-2">📁 Documentos</h2>
            <p class="text-gray-400">Total: <span class="font-bold text-purple-400">124</span></p>
        </div>
        <div class="bg-gray-800 p-5 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-white mb-2">👥 Usuarios</h2>
            <p class="text-gray-400">Activos: <span class="font-bold text-purple-400">8</span></p>
        </div>
        <div class="bg-gray-800 p-5 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-white mb-2">🕒 Pendientes</h2>
            <p class="text-gray-400">Por revisar: <span class="font-bold text-purple-400">16</span></p>
        </div>
    </div>

    {{-- Últimos documentos subidos --}}
    <div class="bg-gray-800 p-6 rounded-xl shadow mb-8">
        <h3 class="text-lg font-semibold text-white mb-4">📄 Últimos documentos</h3>
        <ul class="space-y-2 text-gray-300">
            <li>Acta 123 - <span class="text-sm text-gray-400">Subido el 24 mayo</span></li>
            <li>Constancia ABC - <span class="text-sm text-gray-400">Subido el 23 mayo</span></li>
            <li>Permiso X - <span class="text-sm text-gray-400">Subido el 22 mayo</span></li>
        </ul>
    </div>

    {{-- Mensaje motivacional --}}
    <div class="bg-purple-800/20 border-l-4 border-purple-500 p-4 rounded">
        <p class="text-purple-300">🎯 Recuerda: Un sistema organizado ahorra tiempo y errores.</p>
    </div>
@endsection

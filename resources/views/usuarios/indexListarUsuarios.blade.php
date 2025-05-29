@extends('layouts.template')

@section('title', 'Listado de Usuarios')

@section('content')
    @include('usuarios.parciales.bodyListarUsuarios')
@endsection

@section('scripts')
        {{-- @vite('resources/js/Usuarios/listarUsuarios.js') --}}
        <script src="{{ asset('/plugins/sweetalert.11.22/sweetalert2.all.min.js') }}"></script>
@endsection
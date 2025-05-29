@extends('layouts.template')

@section('styles')
    @vite('resources/css/usuarios/usuarios.css')
@endsection

@section('content')
    @include('usuarios.parciales.bodyAltaUsuarios')
@endsection

@section('scripts')
        @vite('resources/js/Usuarios/altaUsuarios.js')
        <script src="{{ asset('/plugins/sweetalert.11.22/sweetalert2.all.min.js') }}"></script>
@endsection
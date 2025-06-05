@extends('layouts.template')

@section('styles')
    @vite('resources/css/usuarios/sk.css')
@endsection

@section('content')
    @include('documentos.parciales.bodyDetalleDocumentos')
@endsection

@section('scripts')
        {{-- @vite('resources/js/documentos/altaDocumentos.js') --}}
        <script src="{{ asset('/plugins/sweetalert.11.22/sweetalert2.all.min.js') }}"></script>
@endsection
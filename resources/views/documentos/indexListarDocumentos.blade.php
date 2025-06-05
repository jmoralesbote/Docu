@extends('layouts.template')

@section('title', 'Listado de Documentos')

@section('content')
    @include('documentos.parciales.bodyListarDocumentos')
@endsection

@section('scripts')
        @vite('resources/js/documentos/listarDocumentos.js')
        <script src="{{ asset('/plugins/sweetalert.11.22/sweetalert2.all.min.js') }}"></script>
@endsection
@extends('layouts.template')

@section('styles')
    @vite('resources/css/sk/sk.css')
@endsection

@section('content')
    @include('solicitudoc.parciales.bodyListarEntrega')
@endsection

@section('scripts')
        @vite('resources/js/solicitudoc/listarEntrega.js')
        <script src="{{ asset('/plugins/sweetalert.11.22/sweetalert2.all.min.js') }}"></script>
@endsection
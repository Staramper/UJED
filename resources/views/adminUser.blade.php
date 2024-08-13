@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
@stop

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 my-4">
            <user-table></user-table>
        </div>
    </div>
</div>

@stop

@section('css')
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite('resources/sass/app.scss')
@stop

@section('js')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    @vite('resources/js/app.js')
@stop 
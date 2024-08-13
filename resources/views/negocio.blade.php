@extends('adminlte::page')

@section('title', 'Negocios')

@section('content_header')
@stop

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 my-4">
        {{-- @if (auth()->user()->role == 'socio')
            <h1>Mis Negocios</h1>
        @endif --}}
           <business-table 
            :rol="'{{ auth()->user()->role }}'" 
            :nick="'{{ auth()->user()->nick }}'"
            :idu="'{{ auth()->user()->id }}'">
            </business-table>
            {{-- <prueba-component></prueba-component> --}}
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
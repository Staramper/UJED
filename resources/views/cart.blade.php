@extends('adminlte::page')

@section('title', 'Cart')

@section('content_header')
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 my-4">
            <cart-component
            :id="'{{ auth()->user()->id }}'" 
            ></cart-component>
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
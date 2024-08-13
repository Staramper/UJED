@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <!-- <negocio-component
                :rol="'{{ auth()->user()->role }}'" 
                :nick="'{{ auth()->user()->nick }}'"
                :idu="'{{ auth()->user()->id }}'">
                </negocio-component> -->
                <producto-component
                :rol="'{{ auth()->user()->role }}'" 
                :nick="'{{ auth()->user()->nick }}'"
                :idu="'{{ auth()->user()->id }}'">
                </producto-component>
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
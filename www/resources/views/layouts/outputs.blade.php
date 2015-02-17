@extends('layouts.master')

@section('header')
@stop

@section('content')
    @include('outputs.sidebar')
    @yield('main')
@overwrite

@extends('layouts.master')

@section('header')
@stop

@section('content')
    @include('testing.sidebar')
    @yield('main')
@overwrite

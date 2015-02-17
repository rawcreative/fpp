@extends('layouts.master')

@section('header')
@stop

@section('content')
    @include('settings.sidebar')
    @yield('main')
@overwrite

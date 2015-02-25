@extends('layouts.master')

@section('header')
@stop

@section('content')
    @include('settings.sidebar-network')
    @yield('main')
@overwrite

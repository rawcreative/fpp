@extends('layouts.master')

@section('content-class', 'dashboard')
@section('header')
 @include('dashboard.header')
@stop
@section('content')
<div class="content">
	@include('dashboard.widgets.fppd')
	@include('dashboard.widgets.player')
	<div id="dashboard"></div>
	<script id="initial-data" type="text/data">{!! json_encode($initialData) !!}</script>
	<script src="{{asset('js/dashboard-bundle.js')}}"></script>
</div>
@stop
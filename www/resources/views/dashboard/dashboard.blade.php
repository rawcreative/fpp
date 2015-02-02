@extends('layouts.master')

@section('content-class', 'dashboard')
@section('header')
 @include('dashboard.header')
@stop
@section('content')
<div class="content">
	
	@include('dashboard.widgets.fppd')

	@include('dashboard.widgets.player')
	
	@include('dashboard.widgets.playlist')
	
</div>
@stop
@extends('layouts.master')

@section('content-class', 'settings')

@section('header')
@stop
@section('content')
	@section('settings.sidebar')
		@include('settings.sidebar')
	@show
	
	<div class="page-content logs">
		<header class="page-title">
			<h2>FPP Log Settings</h2>
		</header>
		<div class="main">
			{!! Form::open() !!}
			{!! Form::close() !!}
		</div>
	</div>

@stop
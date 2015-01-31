@extends('layouts.master')

@section('content-class', 'settings')

@section('header')
@stop
@section('content')
	@section('settings.sidebar')
		@include('settings.sidebar')
	@show
	
	<div class="page-content network">
		<header class="page-title">
			<h2>FPP Network Settings</h2>
		</header>
		<div class="main">
			{!! Form::open() !!}
			{!! Form::close() !!}
		</div>
	</div>


@stop
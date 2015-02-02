@extends('layouts.master')

@section('content-class', 'settings')

@section('header')
@stop
@section('content')
	
	<div class="page-content email">
		<header class="page-title">
			<h2>FPP Email Settings</h2>
		</header>
		<div class="main">
			{!! Form::open() !!}
			{!! Form::close() !!}
		</div>
	</div>


@stop
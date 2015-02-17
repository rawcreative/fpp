@extends('layouts.master')

@section('content-class', 'outputs')


@section('header')
@stop
@section('content')
	
	<div class="page-content outputs">
		<header class="page-title">
			<h2>FPP Channel Outputs</h2>
		</header>
		<div class="main">
			<div id="universe-outputs"></div>
			<script src="{{ asset('js/outputs-bundle.js') }}"></script>
		</div>		
	</div>

@stop
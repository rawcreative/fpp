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
			<div id="universe-outputs">
				<div class="universe-list">
					<div class="header-row universe">
						<span class="universe-index">#</span>
						<span class="universe-active">Active</span>
						<span class="universe-number">Universe</span>
						<span class="universe-start">Start</span>
						<span class="universe-size">Size</span>
						<span class="universe-type">Type</span>
						<span class="universe-address">Unicast Address</span>
					</div>
					@foreach($universes as $universe)
						@include('io.universe', ['universe' => $universe])
					@endforeach
				</div>
			</div>
		</div>		
	</div>

@stop
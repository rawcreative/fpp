@extends('layouts.settings')

@section('content-class', 'settings')

@section('main')
	<div class="page-content logs">
		<header class="page-title">
			<h2>Log Settings</h2>
		</header>
		<div class="main">
			{!! Form::open() !!}
			<section>
				<h3>Log Level</h3>
				<div class="field">
					
					{!! Form::select('piRTC', [
						'warn' => 'Warn',
						'info' => 'Info',
						'debug' => 'Debug',
						'excess' => 'Excess'
						]) !!}
				</div>
			</section>
			<section>
				<h3>Log Mask</h3>
				<div class="field">
					
					{!! Form::radio('mask_all', 'all') !!}
					{!! Form::label('mask_all', 'ALL') !!}
					{!! Form::radio('mask_all', 'most') !!}
					{!! Form::label('mask_all', 'Most') !!}
				</div>
				<div class="field">
										
				</div>
			</section>
			{!! Form::close() !!}
		</div>
	</div>

@stop
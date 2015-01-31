@extends('layouts.master')

@section('content-class', 'settings')

@section('content')
	@section('settings.sidebar')
		@include('settings.sidebar')
	@show
	
	<div class="page-content">
		<header class="page-title">
			<h1>General Settings</h1>
		</header>
		<div class="main">
			{!! Form::open() !!}

				<div class="field">
					{!! Form::label('blank_screen', 'Blank Screen on Startup') !!}
					{!! Form::checkbox('blank_screen', null, null, ['class' => 'form-control']) !!}
				</div>
				
				<div class="field">
					{!! Form::label('analog_audio', 'Force Analog Audio Output') !!}
					{!! Form::checkbox('analog_audio', null, null, ['class' => 'form-control']) !!}
				</div>

				<div class="field">
					{!! Form::label('lcd_enable', 'Pi 2x16 LCD Enabled') !!}
					{!! Form::checkbox('lcd_enable', null, null, ['class' => 'form-control']) !!}
				</div>
				
				<div class="field">
					{!! Form::label('always_transmit', 'Always transmit channel data') !!}
					{!! Form::checkbox('always_transmit', null, null, ['class' => 'form-control']) !!}
				</div>
				
				<div class="field">
					{!! Form::label('audio_device', 'Audio Output Device') !!}
					{!! Form::select('audio_device', [
					    'alsa' => 'ALSA',
					    'spaniel' => 'Spaniel',
					]) !!}
				</div>

			{!! Form::close() !!}
		</div>		
	</div>

@stop
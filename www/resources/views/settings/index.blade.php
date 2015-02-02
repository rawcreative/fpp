@extends('layouts.master')

@section('content-class', 'settings')

@section('header')
@stop
@section('content')
	
	<div class="page-content">
		<header class="page-title">
			<h2>FPP General Settings</h2>
		</header>
		<div class="main">
			{!! Form::open() !!}
				
				<div class="field columns">
					<div class="left">
						<span>Blank screen on startup</span>
					</div>
					<div class="right">
					<label class="label-switch">
						{!! Form::checkbox('blank_screen', null, null, ['class' => 'form-control']) !!}
						<div class="checkbox"></div>
					</label>
					</div>
				</div>
				
				<div class="field columns">
					<div class="left">
						<span class="">Force Analog Audio Output</span>
					</div>
					<div class="right">
						<label class="label-switch">
							{!! Form::checkbox('analog_audio', null, null, ['class' => 'form-control']) !!}
							<div class="checkbox"></div>
						</label>
					</div>
				</div>

				<div class="field columns">
					<div class="left"><span>Pi 2x16 LCD Enabled</span></div>
					<div class="right">
						<label class="label-switch">
							{!! Form::checkbox('lcd_enable', null, null, ['class' => 'form-control']) !!}
							<div class="checkbox"></div>
						</label>
					</div>
				</div>
				
				<div class="field columns">
					<div class="left"><span>Always transmit channel data</span></div>
					<div class="right">
						<label class="label-switch">
							{!! Form::checkbox('always_transmit', null, null, ['class' => 'form-control']) !!}
							<div class="checkbox"></div>
						</label>
					</div>
				</div>

				<div class="field columns">
					<div class="left"><span>Audio Output Device</span></div>
					<div class="right">
							{!! Form::select('audio_device', $soundCards) !!}
					</div>
				</div>

				<div class="form-actions">
					{!! Form::submit('Save Settings', ['class' => 'button']) !!}

				</div>
					

			{!! Form::close() !!}
		</div>		
	</div>

@stop
@extends('layouts.settings')

@section('content-class', 'date settings')

@section('main')

    <div class="page-content date">
        <header class="page-title">
            <h2>Date & Time Settings</h2>
        </header>
        <div class="main">
            {!! Form::open() !!}
			<section>
				<h3>Manually Set Date/Time</h3>
				<div class="field columns half">
					<div class="left">
						{!! Form::label('manual_date', 'Date') !!}
						{!! Form::text('manual_date') !!}
					</div>
					<div class="right">
						{!! Form::label('manual_time', 'Time') !!}
						{!! Form::text('manual_time') !!}
					</div>
				</div>
			
			</section>
			<section>
				<h3>Real Time Clock</h3>
				<div class="field">
					
					{!! Form::select('piRTC', [
						'N' => 'None',
						'1' => 'RasClock',
						'2' => 'DS1305',
						'3' => 'PiFace'
						]) !!}
				</div>
			</section>
			<section>
				<h3>NTP</h3>
				<div class="field">
					
					{!! Form::radio('ntp', 'enabled') !!}
					{!! Form::label('ntp', 'Enabled') !!}
					{!! Form::radio('ntp', 'disabled') !!}
					{!! Form::label('ntp', 'Disabled') !!}
					
				</div>
			</section>
			<section>
				<h3>Time Zone</h3>
					<div class="field">
					
					{!! Form::select('timezone', [
						
						]) !!}
				</div>
			</section>
			<div class="form-actions">
				{!! Form::submit('Save Settings', ['class' => 'button']) !!}
			</div>
            {!! Form::close() !!}
        </div>
    </div>

@stop
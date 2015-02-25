@extends('layouts.settings')

@section('content-class', 'date settings')

@section('main')

    <div class="page-content date">
       
        <div class="main">
        <div class="panel panel-transparent">
        	<div class="panel-heading"><div class="panel-title">Date & Time Settings</div></div>
			<div class="panel-body">
            {!! Form::open() !!}
			<section>
				<h4><span class="semi-bold">Manually Set</span> Date & Time</h4>
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
			<hr/>
			<section>
				
				<div class="field">
					{!! Form::label('piRTC', 'Real Time Clock') !!}
					{!! Form::select('piRTC', [
						'N' => 'None',
						'1' => 'RasClock',
						'2' => 'DS1305',
						'3' => 'PiFace'
						], $rtc) !!}
				</div>
			</section>
			<section>
			
				<div class="field">
					{!! Form::label('ntp', 'NTP') !!}
					<div>
					{!! Form::radio('ntp', 'enabled', $ntp) !!}
					{!! Form::label('ntp', 'Enabled') !!}
					{!! Form::radio('ntp', 'disabled', !$ntp) !!}
					{!! Form::label('ntp', 'Disabled') !!}
					</div>
				</div>
			</section>
			<section>
					<div class="field">
					{!! Form::label('timezone', 'Time Zone') !!}
					{!! Form::select('timezone', $timezones, $currentTimezone) !!}
				</div>
			</section>
			<div class="form-actions">
				{!! Form::submit('Save Settings', ['class' => 'button']) !!}
			</div>
            {!! Form::close() !!}
        </div>
        </div>
    </div>

@stop
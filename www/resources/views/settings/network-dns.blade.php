@extends('layouts.network')
@section('content-class', 'network settings')
@section('main')
<div class="page-content ">
		
	<div class="main">
		<h3><span class="semi-bold">DNS</span> Settings</h3>

		<div class="panel dns-settings panel-transparent">
			
				{!! Form::open() !!}
				<div class="field">
					{!! Form::label('hostname', 'Hostname') !!}
					{!! Form::text('hostname', $hostname) !!}
				</div>
				<div class="field">
					<label>DNS Server Mode</label>
					{!! Form::radio('dns_server_mode', 'manual', !$dhcp) !!}
					{!! Form::label('dns_server_mode', 'Manual') !!}
					{!! Form::radio('dns_server_mode', 'DHCP', $dhcp) !!}
					{!! Form::label('dns_server_mode', 'DHCP') !!}
				</div>
				<div class="field">
					{!! Form::label('dns_server_1', 'DNS Server 1') !!}
					{!! Form::text('dns_server_1', $dns['DNS1']) !!}
				</div>
				<div class="field">
					{!! Form::label('dns_server_2', 'DNS Server 2') !!}
					{!! Form::text('dns_server_2', $dns['DNS2']) !!}
				</div>
				<div class="form-actions">
				{!! Form::submit('Update DNS', ['class' => 'button']) !!}
				</div>
				{!! Form::close() !!}
		</div>
	</div>
</div>
@stop
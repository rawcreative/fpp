@extends('layouts.master')

@section('content-class', 'settings')

@section('header')
@stop
@section('content')
	<div class="page-content network">
		<header class="page-title">
			<h2>FPP Network Settings</h2>
		</header>
		<div class="main">
			<div class="settings-section interface-settings">
				<h3>Interface Settings</h3>
				{!! Form::open() !!}
				<div class="field">
					{!! Form::label('interface_name', 'Interface Name') !!}
					{!! Form::select('interface_name', []) !!}
				</div>
				<div class="field">
					<label>Interface Mode</label>
					{!! Form::radio('interface_mode', 'static') !!}
					{!! Form::label('interface_mode', 'Static') !!}
					{!! Form::radio('interface_mode', 'DHCP') !!}
					{!! Form::label('interface_mode', 'DHCP') !!}
					
				</div>

				<div class="field">
					{!! Form::label('ip_address', 'IP Address') !!}
					{!! Form::text('ip_address', null) !!}
				</div>
				<div class="field">
					{!! Form::label('netmask', 'Netmask') !!}
					{!! Form::text('netmask', null) !!}
				</div>
				<div class="field">
					{!! Form::label('gateway', 'Gateway') !!}
					{!! Form::text('gateway', null) !!}
				</div>
				<div class="form-actions">
				{!! Form::submit('Update Interface', ['class' => 'button']) !!}
				</div>
				{!! Form::close() !!}
			</div>

			<div class="settings-section dns-settings">
				<h3>DNS Settings</h3>
				{!! Form::open() !!}
				<div class="field">
					{!! Form::label('hostname', 'Hostname') !!}
					{!! Form::text('hostname', null) !!}
				</div>
				<div class="field">
					<label>DNS Server Mode</label>
					{!! Form::radio('dns_server_mode', 'manual') !!}
					{!! Form::label('dns_server_mode', 'Manual') !!}
					{!! Form::radio('dns_server_mode', 'DHCP') !!}
					{!! Form::label('dns_server_mode', 'DHCP') !!}
				</div>
				<div class="field">
					{!! Form::label('dns_server_1', 'DNS Server 1') !!}
					{!! Form::text('dns_server_1', null) !!}
				</div>
				<div class="field">
					{!! Form::label('dns_server_2', 'DNS Server 2') !!}
					{!! Form::text('dns_server_2', null) !!}
				</div>
				<div class="form-actions">
				{!! Form::submit('Update DNS', ['class' => 'button']) !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>


@stop
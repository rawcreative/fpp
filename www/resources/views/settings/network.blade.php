@extends('layouts.network')

@section('content-class', 'network settings')

@section('header')
@stop
@section('main')


	<div class="page-content ">
		
		<div class="main">
			<h3><span class="semi-bold">Available</span> Interfaces</h3>
			<div class="panel interface-settings panel-transparent">


					<ul class="nav nav-tabs nav-tabs-simple" role="tablist">
						@foreach($interfaces as $interface)
							<li class="{{ $interface == reset($interfaces) ? 'active' : '' }}"><a href="#{{$interface}}Tab" data-toggle="tab" role="tab">{{$interface}}</a></li>
						@endforeach
					</ul>
					<div class="tab-content">

						@foreach($interfaces as $interface)

							<div role="tabpanel" id="{{$interface}}Tab" class="tab-pane interface-tab{{ $interface == reset($interfaces) ? ' active' : '' }}">
								{!! Form::open() !!}
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
								@if(starts_with($interface, 'wlan'))
									<div class="section">

										<h4><span class="semi-bold">Wireless</span> Settings</h4>
										<div class="field">
											{!! Form::label('wireless_ssid', 'Wireless SSID (network name)') !!}
											{!! Form::text('wireless_ssid', null) !!}
										</div>
										<div class="field">
											{!! Form::label('wireless_password', 'Wireless Key (password)') !!}
											{!! Form::password('wireless_password', null) !!}
										</div>
									</div>
								@endif
								<div class="form-actions">
									{!! Form::submit('Update Interface', ['class' => 'button']) !!}
								</div>
								{!! Form::close() !!}
							</div>

						@endforeach

					</div>


			</div>

			
		</div>
	</div>


@stop
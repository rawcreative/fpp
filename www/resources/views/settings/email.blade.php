@extends('layouts.settings')

@section('content-class', 'settings')

@section('main')
	
	<div class="page-content email">
		<header class="page-title">
			<h2>Email Settings</h2>
		</header>
		<div class="main">
			<div class="field columns">
				<div class="left">
					<span>Enable Email System</span>
				</div>
				<div class="right">
					<label class="label-switch">
						{!! Form::checkbox('emailenable', null, null, ['class' => 'form-control']) !!}
						<div class="checkbox"></div>
					</label>
				</div>
			</div>
			<div class="field columns">
				<div class="left"><span>Gmail Username</span></div>
				<div class="right">
					{!! Form::email('emailguser', null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="field columns">
				<div class="left"><span>Gmail Password</span></div>
				<div class="right">
					{!! Form::text('emailgpass', null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="field columns">
				<div class="left"><span>Destination From Text</span></div>
				<div class="right">
					{!! Form::text('emailfromtext', null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="field columns">
				<div class="left"><span>Destination To Email</span></div>
				<div class="right">
					{!! Form::text('emailtoemail', null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="form-actions">
				{!! Form::submit('Save All Settings', ['class' => 'button']) !!}
			</div>
		</div>
	</div>


@stop
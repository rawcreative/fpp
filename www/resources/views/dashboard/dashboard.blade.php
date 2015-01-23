@extends('layouts.master')

@section('content-class', 'dashboard')
@section('header')
 @include('dashboard.header')
@stop
@section('content')
<div class="content">
	
	<div class="panel fppd-status">
		<div class="panel-header"><span class="panel-title">FPPD</span></div>
		<div class="panel-body">
			<div class="widget text-center current-status fppd-running">
				<span class="widget-header">Status</span>
				<span class="widget-icon"><i class="icon ion-checkmark-circled success"></i></span>
				<span class="widget-text">Running</span>
				<div class="widget-buttons">
					<a href="#" class="button small secondary gradient fppd-stop"><i class="icon ion-close"></i> Stop</a>
					<a href="#" class="button small secondary gradient fppd-restart"><i class="icon ion-refresh"></i> Restart</a>
				</div>
			</div>
			<div class="widget text-center current-status">
				<span class="widget-header">Status</span>
				<span class="widget-icon"><i class="icon ion-record secondary"></i></span>
				<span class="widget-text">Standalone</span>
				<div class="widget-buttons">
					<select class="fppd-mode-select">
						<option value="standalone" selected="selected">Standalone</option>
						<option value="master" >Master</option>
						<option value="remote" >Remote</option>
						<option value="bridge" >Bridge</option>
					</select>
					<a class="button small secondary gradient fppd-mode-apply">Apply</a>
				</div>
			</div>
		</div>
		
	</div>
	<div class="panel player-status">
		<div class="panel-header"><span class="panel-title">Player</span></div>
		<div class="panel-body"></div>
		<div class="panel-footer"></div>
	</div>
	<div class="panel playlist-info">
		<div class="panel-body"></div>
		<div class="panel-footer"></div>
	</div>
</div>
@stop
@extends('layouts.master')

@section('content-class', 'schedule')

@section('header')
	@include('schedule.header')
@stop
@section('content')
	<div class="page-content schedule">
		<div class="main">
			
			<div class="schedule-list panel">
				<div class="panel-body">
					<div class="header-row schedule">
						<span class="schedule-index">#</span>
						<span class="schedule-active">Enable</span>
						<span class="schedule-dates">First & Last Run Dates</span>
						<span class="schedule-playlist">Playlist</span>
						<span class="schedule-times">Start & End Times</span>
						<span class="schedule-repeat">Repeat</span>
					</div>
				
					@forelse($schedules as $schedule)
						@include('schedule.schedule', ['schedule' => (object)$schedule])
					@empty
					<div class="no-schedule">
						<p>No schedules currently defined</p>
					</div>
					@endforelse
				</div>
			</div>
		</div>
	</div>

@stop
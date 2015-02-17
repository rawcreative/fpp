@extends('layouts.outputs')

@section('content-class', 'outputs settings other')


@section('main')
	
	<div class="page-content outputs">
		<header class="page-title">
			<h2>FPP Channel Outputs</h2>
		</header>
		<div class="main">
			<div id="universe-outputs">
				<div class="universe-list">
					<div class="header-row universe">
						<span class="universe-index">#</span>
						<span class="universe-active">Active</span>
						<span class="universe-type">Type</span>
						<span class="universe-start">Start</span>
						<span class="universe-size">Count</span>
						<span class="universe-config">Output Config</span>
					</div>
				</div>
			</div>
		</div>		
	</div>

@stop
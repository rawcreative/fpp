@extends('layouts.outputs')

@section('content-class', 'outputs settings other')


@section('main')
	
	<div class="page-content outputs">
		<header class="page-title">
			<h2>FPP Channel Outputs</h2>
		</header>
		<div class="main">
			<div id="channel-outputs">
				<div class="output-list">
					<div class="header-row output">
						<span class="output-index">#</span>
						<span class="output-active">Active</span>
						<span class="output-type">Type</span>
						<span class="output-start">Start</span>
						<span class="output-size">Count</span>
						<span class="output-config">Output Config</span>
					</div>
				</div>
			</div>
		</div>		
	</div>

@stop
@extends('layouts.master')

@section('header')
	@include('models.header')
@stop

@section('content')
<div class="page-content model-overlays">
		
		<div class="main">
			<div id="overlay-models">
				<div class="model-overlay-list panel">
					<div class="panel-body">
						<div class="header-row model">
							<span class="model-name">Model Name</span>
							<span class="model-start">Start Ch.</span>
							<span class="model-count">Ch. Count</span>
							<span class="model-orientation">Orientation</span>
							<span class="model-start-corner">Start Corner</span>
							<span class="model-strings">Strings</span>
							<span class="model-strands">Strands</span>
						</div>
					
						@forelse($models as $model)
							@include('models.model', ['model' => (object)$model])
						@empty
						<div class="no-models">
							<p>No overlay models currently defined</p>
						</div>
						@endforelse
					</div>
				</div>
			</div>
		</div>		
	</div>

@stop
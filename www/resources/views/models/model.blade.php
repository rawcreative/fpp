<div class="model">
	<div class="cell model-name">
		{!! Form::text('model_name', $model->name) !!}</div>
	<div class="cell model-start">
		{!! Form::text('model_start', $model->startAddress) !!}
	</div>
	<div class="cell model-count">
		{!! Form::text('model_count', $model->count) !!}
	</div>
	<div class="cell model-orientation">
		{!! Form::select('model_orientation', [
			'horizontal' => 'Horizontal',
			'vertical' => 'Vertical'], $model->orientation)  !!}
	</div>
	<div class="cell model-start-corner">
		{!! Form::select('model_start_corner', [
			'top_left' => 'Top Left',
			'top_right' => 'Top Right',
			'bottom_left' => 'Bottom Left',
			'bottom_right' => 'Bottom Right'], $model->start_corner)  !!}
	</div>
	<div class="cell model-strings">
		{!! Form::text('model_strings', $model->strings) !!}
	</div>
	<div class="cell model-strands">
		{!! Form::text('model_strands', $model->strands) !!}
	</div>
	<button class="button hollow alert"><i class="ion-close"></i></button>
</div>
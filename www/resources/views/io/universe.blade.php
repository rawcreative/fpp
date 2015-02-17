<div class="universe">
	<div class="cell universe-index">{{ $index }}</div>
	<div class="cell universe-active">
		{!! Form::checkbox('active', '1', $universe->active) !!}
	</div>
	<div class="cell universe-number">
		{!! Form::number('universe_number', $universe->universe) !!}
	</div>
	<div class="cell universe-start">
		{!! Form::number('universe_start', $universe->startAddress) !!}
	</div>
	<div class="cell universe-size">
		{!! Form::number('universe_size', $universe->size) !!}
	</div>
	<div class="cell universe-type">
		{!! Form::select('universe_type', [
			'unicast' => 'Unicast',
			'multicast' => 'Multicast'], $universe->type)  !!}
	</div>
	<div class="cell universe-address">
		{!! Form::text('unicast_address', $universe->unicastAddress) !!}
	</div>
	<button class="button hollow alert"><i class="ion-close"></i></button>
</div>
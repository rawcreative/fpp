<div class="panel player-status">
	<div class="panel-header"><span class="panel-title">Player</span></div>
	<div class="panel-body">
		<div class="player-header player-row">
			<div class="status">
				<span class="label">Status: </span>
				<span class="value">Idle</span>
			</div>
			<div class="playlist">
				<span class="label">Playlist: </span>
				<span class="playlist-select">
					{!! Form::select('playlist', [], null, ['class' => 'playlist']) !!}
					<a href="#" class="button tiny hollow">Load</a>
				</span>
			</div>
		</div>
		<div class="player-row now-playing"></div>
		<div class="player-row player-buttons">
			<a href="#" class="button small play"><i class="icon ion-play"></i> Play</a>
			<a href="#" class="button small stop-now"><i class="icon ion-stop"></i> Stop Now</a>
			<a href="#" class="button small stop-gracefully"><i class="icon ion-stop"></i> Stop Gracefully</a>
			<a href="#" class="button small shuffle"><i class="icon ion-shuffle"></i> Shuffle</a>
			<a href="#" class="button small repeat"><i class="icon ion-refresh"></i> Repeat</a>
			<div class="volume">
				<i class="icon ion-volume-medium"></i> <input type="range" name="volume" class="volume-input" id="fpp-volume"/>
			</div>
		</div>
	</div>
	<div class="panel-footer"></div>
</div>
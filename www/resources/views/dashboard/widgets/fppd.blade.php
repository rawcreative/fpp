<div class="panel fppd-status" data-pages="portlet">
	<div class="panel-heading separator">
		<div class="panel-title">FPPD</div>
		<div class="panel-controls">
		    <ul>
		      <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a>
		      </li>
		      <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a>
		      </li>
		      <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a>
		      </li>
		    </ul>
	  </div>
	</div>
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
			<span class="widget-header">Mode</span>
			<span class="widget-icon"><img src="{{asset('images/standalone-icon.svg')}}"></span>
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
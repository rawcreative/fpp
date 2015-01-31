<div class="settings-sidebar">
	<h2>Settings</h2>
	<ul class="nav">
	    <li class="{{set_active('settings')}}"><a href="{{route('settings')}}">General</a></li>
	    <li class="{{set_active('settings/network')}}"> <a href="{{ route('settings.network') }}">Network</a></li>
	    <li class="{{set_active('settings/email')}}"> <a href="{{ route('settings.email') }}">Email</a></li>
	    <li class="{{set_active('settings/logs')}}"> <a href="{{ route('settings.logs') }}">Logs</a></li>
	</ul>
</div>
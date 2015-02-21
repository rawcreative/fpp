<aside id="sidebar-left" class="sidebar affix">

    <div class="logo">
        <a href="" title="Falcon Player"><img src="{{ asset('images/logo.png') }}"></a>
    </div>

    <div class="sidebar-menu">
        <div class="menu-section">
            <h4>Control</h4>
            <ul class="nav">
                @section('menu-control')
                <li class="{{set_active('dashboard')}}"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Display Testing</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Events</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Effects</a></li>
                @show
            </ul>
        </div>

        <div class="menu-section">
            <h4>Content</h4>
            <ul class="nav">
                @section('menu-content')
                <li class="{{set_active('/files')}}"> <a href="{{route('files')}}">File Manager</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Playlists</a></li>
                <li class="{{set_active('/')}}"> <a href="{{route('schedule')}}">Schedule</a></li>
                <li class="{{set_active('/plugins')}}"> <a href="{{route('plugins')}}">Plugins</a></li>
                @show
            </ul>
        </div>

        <div class="menu-section">
            <h4>Settings</h4>
            <ul class="nav">
                @section('menu-settings')
                <li class="{{set_active('settings')}}"> <a href="{{route('settings')}}" >General</a></li>
                <li class="{{set_active('settings/network')}}"> <a href="{{route('settings.network')}}">Network</a></li>
                <li class="{{set_active('/outputs')}}"> <a href="{{ route('outputs') }}">Channel Outputs</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Overlay Models</a></li>
                @show
            </ul>
        </div>
    </div>
</aside>

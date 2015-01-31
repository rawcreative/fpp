<aside id="sidebar-left" class="sidebar affix">

    <div class="logo">
        <a class="navbar-brand" href="" title="Falcon Player"><img src="{{ asset('images/logo.png') }}"></a>
    </div>

    <div class="sidebar-menu">
        <div class="menu-section">
            <h4>Control</h4>
            <ul class="nav">
                <li class="{{set_active('dashboard')}}"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Display Testing</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Events</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Effects</a></li>
            </ul>
        </div>

        <div class="menu-section">
            <h4>Content</h4>
            <ul class="nav">
                <li class="{{set_active('/')}}"> <a href="">File Manager</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Playlists</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Schedule</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Plugins</a></li>
            </ul>
        </div>

        <div class="menu-section">
            <h4>Input/Output</h4>
            <ul class="nav">
                <li class="{{set_active('/')}}"> <a href="">Channel Outputs</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Overlay Models</a></li>
            </ul>
        </div>

        <div class="menu-section">
            <h4>Settings</h4>
            <ul class="nav">
                <li class="{{set_active('settings')}}"> <a href="{{route('settings')}}" >General</a></li>
                <li class="{{set_active('/')}}"> <a href="#">Network</a></li>
            </ul>
        </div>
    </div>
</aside>

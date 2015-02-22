<aside id="sidebar-left" class="sidebar affix">

    <div class="logo">
        <a href="" title="Falcon Player"><img src="{{ asset('images/logo.png') }}"></a>
    </div>

    <div class="sidebar-menu">
        <div class="menu-section">
            <h4>Control</h4>
            {!! Menu::get('control')->asUl(['class' => 'nav']) !!}
        </div>

        <div class="menu-section">
            <h4>Content</h4>
            {!! Menu::get('content')->asUl(['class' => 'nav']) !!}
        </div>

        <div class="menu-section">
            <h4>Settings</h4>
            {!! Menu::get('settings')->asUl(['class' => 'nav']) !!}
        </div>
    </div>
</aside>

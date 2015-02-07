<!DOCTYPE html>
<html lang="en">
<head>
    <title>Falcon Player | @yield('title', 'Player Control')</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon">

<!-- stylesheets -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
@yield('styles')

<!-- javascript -->
<script src="{{ asset('js/bs.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

@yield('scripts')

</head>

<body class="@yield('body-class', 'page')">
<div id="wrapper" class="wrapper">
    <div id="main" role="main">
        @section('left-sidebar')
            @include('partials.sidebar')
        @show

        <section class="content-wrapper @yield('content-class', 'frame')">
            @section('header')
                @include('partials.header')
            @show

            @yield('content')

            @section('footer')
                @include('partials.footer')
            @show
        </section>
    </div>
</div>
</body>
</html>


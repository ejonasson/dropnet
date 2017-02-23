<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="nav">
            <div class="container">
                <!-- Collapsed Hamburger -->
                <span class="nav-toggle">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>

                <div class="nav-left nav-menu">
                    <a class="nav-item" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="nav-right nav-menu">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <a class="nav-item is-tab" href="{{ url('/login') }}">Login</a>
                        <a class="nav-item is-tab" href="{{ url('/register') }}">Register</a>
                    @else

                    <a class="nav-item is-tab" href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                    </form>
                    @endif
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>

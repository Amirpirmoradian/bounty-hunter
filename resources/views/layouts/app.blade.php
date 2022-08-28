<html lang="{{ app()->getLocale() }}"  dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bounty Hunter') }}</title>
    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/pictures/logo.png') }}" alt="Mootanroo Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @if(auth()->user() != null && (auth()->user()->type == "seller" || auth()->user()->type == "admin"))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('panel') }}">{{ __('پنل') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('referrals') }}">{{ __('ارجاع داده شده ها') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shelf') }}">{{ __('قفسه') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shelfInStock') }}">{{ __('موجودی') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shelfSold') }}">{{ __('سفارشات') }}</a>
                            </li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            <div class="container">
            @yield('content')
            </div>
        </main>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/main.js') }}" defer></script>

</body>
</html>
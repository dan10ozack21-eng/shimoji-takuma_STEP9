<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Home</a>
                        </li>

                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mypage') }}">マイページ</a>
                        </li>
                        @endauth

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">お問い合わせ</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
                    @guest
                        @if (Route::has('login'))
                        <li class="nav-item me-2">            
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>        
                        @endif

        
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>                  
                        </li>     
                        @endif
    
                        @else 
                        <li class="nav-item me-3 text-muted">
                        ログインユーザー：<strong>{{ Auth::user()->name }}</strong>
                        </li>

                        <li class="nav-item">
                        <a class="btn btn-outline-danger btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf            
                        </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-white border-top py-3 mt-auto">
            <div class="container text-center text-muted">
                <a href="{{ route('contact') }}" class="btn btn-primary">お問い合わせ</a>
                <div class="d-flex justify-content-center gap-3 mb-2">
                    <a href="{{ route('index') }}" class="text-decoration-none text-secondary">Home</a>
                    <a href="{{ route('mypage') }}" class="text-decoration-none text-secondary">マイページ</a>
                </div>
            </div>

        </footer>
    </div>
</body>
</html>

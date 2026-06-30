<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CyTech EC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="custom-header d-flex px-5">
                <a class="navbar-brand" href="{{ url('/index') }}">
                    CyTech EC
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
<!--                    <ul class="navbar-nav me-auto">
                        
                    </ul>
-->
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link" href="{{ route('index') }}">Home</a>
                        </li>

                        @auth
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link" href="{{ route('mypage') }}">マイページ</a>
                        </li>
                        @endauth


                    @guest
                        @if (Route::has('login'))
                        <li class="nav-item mx-2">            
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

        <main class="flex-grow-1 py-4">
            @yield('content')
        </main>

        <footer class="custom-footer border-top p-0 mt-auto">

            <div class="footer-links-area text-center text-muted py-3">
                <a href="{{ route('contact') }}" class="btn btn-primary">お問い合わせ</a>
                <div class="d-flex justify-content-center gap-3 mt-2 mb-0">
                    <a href="{{ route('index') }}" class="nav-link custom-nav-link">Home</a>
                    @auth
                    <a href="{{ route('mypage') }}" class="nav-link custom-nav-link">マイページ</a>
                    @endauth
                </div>
                
            </div>

            <div class="footer-copy-area text-center py-3 w-100 m-0">
                <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            </div>

        </footer>
    </div>
</body>
</html>

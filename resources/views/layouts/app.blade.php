<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TravelFly - Premium Online Travel Agent')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-D30GLM32.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body>

    <nav class="navbar">
        <div class="container nav-content">
            <a href="/" class="logo">TravelFly</a>
            
            <div class="nav-links">
                <a href="{{ route('flights.index') }}">Tiket Pesawat</a>
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="/admin" style="color: var(--secondary);">Panel Admin</a>
                    @endif
                    <a href="{{ route('user.bookings') }}">Pesanan Saya</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-link" style="color: var(--danger); font-weight: 700;">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 0.6rem 1.5rem;">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 0.6rem 1.5rem;">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="main-content">
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

   
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Bali Housing Assist')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    <header class="navbar bg-base-100 shadow-sm px-4 lg:px-8">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="text-xl font-bold text-primary">Bali Housing Assist</a>
        </div>
        <div class="flex-none hidden lg:block">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ route('properties.index') }}">Properties</a></li>
                <li><a>About Us</a></li>
                <li><a>Contact</a></li>
            </ul>
        </div>
        <div class="flex-none">
            <div class="dropdown dropdown-end lg:hidden">
                <button class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                </button>
                <ul class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="{{ route('properties.index') }}">Properties</a></li>
                    <li><a>About Us</a></li>
                    <li><a>Contact</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="footer p-10 bg-base-200 text-base-content border-t">
        <aside>
            <p class="font-bold text-lg">Bali Housing Assist</p>
            <p>Providing the best rental properties in Bali since 2024.</p>
        </aside> 
        <nav>
            <h6 class="footer-title">Services</h6> 
            <a class="link link-hover">Villas</a>
            <a class="link link-hover">Guest Houses</a>
            <a class="link link-hover">Lofts</a>
        </nav> 
        <nav>
            <h6 class="footer-title">Company</h6> 
            <a class="link link-hover">About us</a>
            <a class="link link-hover">Contact</a>
        </nav> 
        <nav>
            <h6 class="footer-title">Legal</h6> 
            <a class="link link-hover">Terms of use</a>
            <a class="link link-hover">Privacy policy</a>
        </nav>
    </footer>
</body>
</html>

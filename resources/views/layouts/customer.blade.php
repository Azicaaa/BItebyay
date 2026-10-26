<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $title ?? 'BitebyAy')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|poppins:500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased overflow-x-hidden">

    <div class="min-h-screen bg-pink-50">

        {{-- Navbar --}}
        <nav class="bg-white border-b border-pink-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

                <div class="h-20 flex items-center justify-between">

                    {{-- Logo --}}
                    <a href="{{ route('home') }}"
                    class="flex-shrink-0">

                        <span
                            class="text-4xl font-bold tracking-tight text-pink-600"
                            style="font-family: 'Brush Script MT', 'Segoe Script', cursive;">
                            BitebyAy
                        </span>

                    </a>


                    {{-- ================= DESKTOP MENU ================= --}}
                    <div class="hidden md:flex items-center gap-10">

                        <a href="{{ route('home') }}"
                        class="text-gray-700 font-medium hover:text-pink-600 transition">
                            Home
                        </a>

                        <a href="{{ route('home') }}#menu"
                        class="text-gray-700 font-medium hover:text-pink-600 transition">
                            Menu
                        </a>

                        <a href="{{ route('home') }}#about"
                        class="text-gray-700 font-medium hover:text-pink-600 transition">
                            About
                        </a>

                        <a href="{{ route('home') }}#contact"
                        class="text-gray-700 font-medium hover:text-pink-600 transition">
                            Contact
                        </a>

                    </div>


                    {{-- ================= DESKTOP RIGHT ================= --}}
                    <div class="hidden md:flex items-center gap-5">

                        {{-- Search --}}
                        <button
                            type="button"
                            class="text-gray-700 hover:text-pink-600 transition"
                            title="Search">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"/>

                            </svg>

                        </button>


                        {{-- Account --}}
                        @auth

                            <div x-data="{ open: false }"
                                class="relative">

                                <button
                                    @click="open = !open"
                                    class="text-gray-700 hover:text-pink-600 transition"
                                    title="Account">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"/>

                                    </svg>

                                </button>


                                <div
                                    x-show="open"
                                    @click.outside="open = false"
                                    x-transition
                                    class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-pink-100 py-2">

                                    <div class="px-4 py-3 border-b border-pink-100">
                                        <p class="text-sm font-semibold text-gray-800">
                                            {{ Auth::user()->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>

                                    <a
                                        href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition"
                                    >
                                        Profil
                                    </a>

                                    <a
                                        href="{{ route('customer.orders.index') }}"
                                        class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition"
                                    >
                                        Pesanan Saya
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button
                                            type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">
                                            Logout
                                        </button>
                                    </form>

                                </div>

                            </div>

                        @else

                            <a href="{{ route('login') }}"
                            class="text-gray-700 hover:text-pink-600 transition"
                            title="Login">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"/>

                                </svg>

                            </a>

                        @endauth


                        {{-- Cart --}}
                        @php
                            $cartCount = collect(session('cart', []))->sum('quantity');
                        @endphp

                        <a
                            href="{{ route('cart.index') }}"
                            class="relative text-gray-700 hover:text-pink-600 transition"
                            title="Keranjang"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M2.25 3h1.5l1.5 12h13.5l1.5-9H5.25M9 21h.01M18 21h.01"
                                />

                            </svg>


                            @if ($cartCount > 0)

                                <span
                                    class="absolute -top-2 -right-2
                                        min-w-5 h-5 px-1
                                        bg-pink-600
                                        text-white
                                        text-xs
                                        rounded-full
                                        flex items-center justify-center"
                                >
                                    {{ $cartCount }}
                                </span>

                            @endif

                        </a>

                    </div>


                    {{-- ================= MOBILE ================= --}}
                    <div
                        class="md:hidden"
                        x-data="{ open: false }">

                        <button
                            @click="open = !open"
                            class="text-gray-700 hover:text-pink-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-7 h-7"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"/>

                            </svg>

                        </button>


                        {{-- Mobile Menu --}}
                        <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute top-20 left-0 right-0 bg-white border-t border-pink-100 shadow-lg">

                            <div class="px-6 py-5 space-y-4">

                                <a href="{{ route('home') }}"
                                class="block text-gray-700 hover:text-pink-600">
                                    Home
                                </a>

                                <a href="{{ route('home') }}#menu"
                                class="block text-gray-700 hover:text-pink-600">
                                    Menu
                                </a>

                                <a href="{{ route('home') }}#about"
                                class="block text-gray-700 hover:text-pink-600">
                                    About
                                </a>

                                <a href="{{ route('home') }}#contact"
                                class="block text-gray-700 hover:text-pink-600">
                                    Contact
                                </a>

                                <div class="border-t border-pink-100 pt-4">

                                    <a href="#"
                                    class="block text-gray-700 hover:text-pink-600">
                                        🛒 Keranjang
                                    </a>

                                </div>

                                @auth

                                    <a
                                        href="{{ route('profile.edit') }}"
                                        class="block text-gray-700 hover:text-pink-600"
                                    >
                                        Profil
                                    </a>

                                    <a
                                        href="{{ route('customer.orders.index') }}"
                                        class="block text-gray-700 hover:text-pink-600"
                                    >
                                        Pesanan Saya
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button
                                            type="submit"
                                            class="text-gray-700 hover:text-pink-600">
                                            Logout
                                        </button>
                                    </form>

                                @else

                                    <a href="{{ route('login') }}"
                                    class="block text-pink-600 font-medium">
                                        Login
                                    </a>

                                @endauth

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </nav>

        {{-- Konten halaman --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer>
            @include('partials.footer')
        </footer>

    </div>

</body>
</html>
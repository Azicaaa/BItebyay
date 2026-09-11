<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin BitebyAy' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    {{-- =========================================================
        SIDEBAR
    ========================================================== --}}

    <aside
        style="
            position: fixed;
            top: 0;
            left: 0;
            width: 256px;
            height: 100vh;
            z-index: 50;
        "
        class="bg-pink-600 text-white flex flex-col"
    >

        {{-- Logo --}}

        <div class="px-6 pt-6 pb-4">

            <a
                href="{{ route('admin.dashboard') }}"
                class="block text-center"
            >

                <span
                    class="text-3xl font-bold"
                    style="font-family: 'Brush Script MT', 'Segoe Script', cursive;"
                >
                    BitebyAy
                </span>

            </a>

        </div>


        {{-- Kembali ke toko --}}

        <div class="px-5">

            <a
                href="{{ route('home') }}"
                class="flex items-center justify-center gap-2
                       w-full
                       px-4 py-2
                       rounded-full
                       border border-white
                       text-white
                       font-semibold
                       hover:bg-white/10
                       transition"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
                    />
                </svg>

                Kembali ke Toko

            </a>

        </div>


        {{-- =====================================================
            MENU
        ====================================================== --}}

        <nav class="px-4 mt-6 space-y-2 flex-1">

            {{-- Dashboard --}}

            <a
                href="{{ route('admin.dashboard') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    font-semibold
                    transition
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-white text-pink-600'
                        : 'text-white hover:bg-white/10' }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 13h8V3H3v10Zm0 8h8v-5H3v5Zm10 0h8V11h-8v10Zm0-18v5h8V3h-8Z"
                    />
                </svg>

                Dashboard

            </a>


            {{-- Produk --}}

            <a
                href="{{ route('admin.products.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    font-semibold
                    transition
                    {{ request()->routeIs('admin.products.*')
                        ? 'bg-white text-pink-600'
                        : 'text-white hover:bg-white/10' }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20 7.5 12 3 4 7.5m16 0L12 12m8-4.5V16.5L12 21m0-9L4 7.5m8 4.5v9M4 7.5V16.5L12 21"
                    />
                </svg>

                Produk

            </a>


            {{-- Pesanan --}}

            <a
                href="{{ route('admin.orders.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    font-semibold
                    transition
                    {{ request()->routeIs('admin.orders.*')
                        ? 'bg-white text-pink-600'
                        : 'text-white hover:bg-white/10' }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 4h12a2 2 0 0 1 2 2v14H4V6a2 2 0 0 1 2-2Zm3 4h6m-6 4h6m-6 4h4"
                    />
                </svg>

                Pesanan

            </a>


            {{-- Pelanggan --}}

            <a
                href="{{ route('admin.customers.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    font-semibold
                    transition
                    {{ request()->routeIs('admin.customers.*')
                        ? 'bg-white text-pink-600'
                        : 'text-white hover:bg-white/10' }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 8 0Zm8-1a3 3 0 1 0 0-6m4 17v-2a4 4 0 0 0-3-3.87"
                    />
                </svg>

                Pelanggan

            </a>


            {{-- Laporan --}}

            <a
                href="{{ route('admin.reports.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    font-semibold
                    transition
                    {{ request()->routeIs('admin.reports.*')
                        ? 'bg-white text-pink-600'
                        : 'text-white hover:bg-white/10' }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 19V5m0 14h16M8 16v-5m4 5V8m4 8V6"
                    />
                </svg>

                Laporan

            </a>

        </nav>


        {{-- =====================================================
            LOGOUT
        ====================================================== --}}

        <div class="px-5 pb-6">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="
                        w-full
                        flex items-center justify-center gap-2
                        px-4 py-3
                        rounded-xl
                        text-white
                        font-semibold
                        hover:bg-white/10
                        transition
                    "
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12H3m0 0 4-4m-4 4 4 4M21 5v14a2 2 0 0 1-2 2h-6"
                        />
                    </svg>

                    Logout

                </button>

            </form>

        </div>

    </aside>



    {{-- =========================================================
        AREA KANAN
    ========================================================== --}}

    <div
        style="
            margin-left: 256px;
            min-height: 100vh;
        "
    >

        {{-- =====================================================
            TOP NAVBAR
        ====================================================== --}}

        <header
            style="
                position: fixed;
                top: 0;
                left: 256px;
                right: 0;
                height: 80px;
                z-index: 40;
            "
            class="
                bg-white
                border-b border-gray-200
                shadow-sm
            "
        >

            <div
                class="
                    h-full
                    px-10
                    flex
                    items-center
                    justify-between
                "
            >

                {{-- =========================
                    HEADER LEFT
                ========================== --}}

                <div>

                    <p class="text-sm text-gray-500">
                        Admin Panel
                    </p>

                    <h1 class="text-lg font-bold text-gray-800">
                        BitebyAy
                    </h1>

                </div>


                {{-- =========================
                    PROFILE MENU
                ========================== --}}

                <div class="relative">

                    <button
                        type="button"
                        onclick="document.getElementById('admin-profile-menu').classList.toggle('hidden')"
                        class="
                            w-10 h-10
                            rounded-full
                            bg-pink-100
                            flex
                            items-center
                            justify-center
                            text-pink-600
                            font-bold
                            text-base
                            hover:bg-pink-200
                            transition
                            focus:outline-none
                        "
                        title="{{ auth()->user()->name ?? 'Admin' }}"
                    >
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </button>


                    {{-- Dropdown --}}

                    <div
                        id="admin-profile-menu"
                        class="
                            hidden
                            absolute
                            right-0
                            top-12
                            w-56
                            bg-white
                            rounded-2xl
                            border
                            border-gray-200
                            shadow-lg
                            overflow-hidden
                        "
                    >

                        {{-- Nama akun --}}

                        <div class="px-4 py-3 border-b border-gray-100">

                            <p class="text-sm font-semibold text-gray-800">
                                {{ auth()->user()->name ?? 'Admin' }}
                            </p>

                            <p class="mt-0.5 text-xs text-gray-400">
                                {{ auth()->user()->email ?? '' }}
                            </p>

                        </div>


                        {{-- Profile --}}

                        <a
                            href="{{ route('profile.edit') }}"
                            class="
                                flex
                                items-center
                                gap-3
                                px-4
                                py-3
                                text-sm
                                font-medium
                                text-gray-700
                                hover:bg-pink-50
                                hover:text-pink-600
                                transition
                            "
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                                />
                            </svg>

                            Profil

                        </a>


                        {{-- Logout --}}

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="
                                    w-full
                                    flex
                                    items-center
                                    gap-3
                                    px-4
                                    py-3
                                    text-sm
                                    font-medium
                                    text-red-600
                                    hover:bg-red-50
                                    transition
                                "
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12H3m0 0 4-4m4 4-4 4M21 5v14a2 2 0 0 1-2 2h-6"
                                    />
                                </svg>

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </header>



        {{-- =====================================================
            PAGE CONTENT
        ====================================================== --}}

        <main
            style="
                padding-top: 80px;
            "
        >

            <div class="p-6 lg:p-8">

                @yield('content')

            </div>

        </main>

    </div>


</body>
</html>
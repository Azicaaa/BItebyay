<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Login - BitebyAy</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>


<body class="min-h-screen bg-pink-50">


    {{-- =====================================================
        BACKGROUND
    ====================================================== --}}

    <div class="fixed inset-0 overflow-hidden pointer-events-none">

        <div
            class="
                absolute
                -top-32
                -left-32
                w-96
                h-96
                rounded-full
                bg-pink-100
                opacity-60
            "
        ></div>

        <div
            class="
                absolute
                -bottom-40
                -right-32
                w-[500px]
                h-[500px]
                rounded-full
                bg-pink-100
                opacity-70
            "
        ></div>

        <div
            class="
                absolute
                top-20
                right-20
                w-32
                h-32
                rounded-full
                border
                border-pink-200
                opacity-60
            "
        ></div>

        <div
            class="
                absolute
                bottom-20
                left-20
                w-24
                h-24
                rounded-full
                border
                border-pink-200
                opacity-60
            "
        ></div>

    </div>



    {{-- =====================================================
        LOGIN WRAPPER
    ====================================================== --}}

    <div
        class="
            relative
            min-h-screen
            flex
            flex-col
            items-center
            justify-center
            px-4
            py-10
        "
    >


        {{-- =================================================
            LOGIN CARD
        ================================================== --}}

        <div
            class="
                w-full
                max-w-md
                bg-white
                rounded-3xl
                border
                border-pink-100
                shadow-xl
                shadow-pink-100/50
                px-7
                py-8
                sm:px-10
                sm:py-10
            "
        >


            {{-- =============================================
                LOGO
            ============================================== --}}

            <div class="text-center">

                <a
                    href="{{ route('home') }}"
                    class="inline-block"
                >

                    <span
                        class="
                            text-5xl
                            sm:text-6xl
                            font-bold
                            text-pink-600
                            leading-none
                        "
                        style="
                            font-family:
                            'Brush Script MT',
                            'Segoe Script',
                            cursive;
                        "
                    >
                        BitebyAy
                    </span>

                </a>


                <h1
                    class="
                        mt-6
                        text-xl
                        font-bold
                        text-gray-800
                    "
                >
                    Selamat datang kembali!
                </h1>


                <p
                    class="
                        mt-2
                        text-sm
                        text-gray-500
                    "
                >
                    Login untuk melanjutkan ke BitebyAy.
                </p>

            </div>



            {{-- =============================================
                DIVIDER
            ============================================== --}}

            <div class="my-7 border-t border-gray-100"></div>



            {{-- =============================================
                SESSION STATUS
            ============================================== --}}

            @if (session('status'))

                <div
                    class="
                        mb-5
                        rounded-xl
                        border
                        border-green-200
                        bg-green-50
                        px-4
                        py-3
                        text-sm
                        text-green-700
                    "
                >
                    {{ session('status') }}
                </div>

            @endif



            {{-- =============================================
                VALIDATION ERROR
            ============================================== --}}

            @if ($errors->any())

                <div
                    class="
                        mb-5
                        rounded-xl
                        border
                        border-red-200
                        bg-red-50
                        px-4
                        py-3
                        text-sm
                        text-red-700
                    "
                >

                    <p class="font-semibold">
                        Login gagal.
                    </p>

                    <p class="mt-1">
                        Email atau password yang kamu masukkan salah.
                    </p>

                </div>

            @endif



            {{-- =============================================
                LOGIN FORM
            ============================================== --}}

            <form
                method="POST"
                action="{{ route('login') }}"
                class="space-y-5"
            >

                @csrf


                {{-- =========================================
                    EMAIL
                ========================================== --}}

                <div>

                    <label
                        for="email"
                        class="
                            block
                            text-sm
                            font-semibold
                            text-gray-700
                        "
                    >
                        Email
                    </label>


                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="nama@email.com"
                        class="
                            mt-2
                            block
                            w-full
                            rounded-xl
                            border
                            border-gray-200
                            bg-white
                            px-4
                            py-3
                            text-sm
                            text-gray-800
                            placeholder-gray-400
                            outline-none
                            transition
                            focus:border-pink-500
                            focus:ring-4
                            focus:ring-pink-100
                        "
                    >

                </div>



                {{-- =========================================
                    PASSWORD
                ========================================== --}}

                <div>

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                        "
                    >

                        <label
                            for="password"
                            class="
                                block
                                text-sm
                                font-semibold
                                text-gray-700
                            "
                        >
                            Password
                        </label>


                        @if (Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="
                                    text-xs
                                    font-semibold
                                    text-pink-600
                                    hover:text-pink-700
                                    transition
                                "
                            >
                                Lupa password?
                            </a>

                        @endif

                    </div>


                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password"
                        class="
                            mt-2
                            block
                            w-full
                            rounded-xl
                            border
                            border-gray-200
                            bg-white
                            px-4
                            py-3
                            text-sm
                            text-gray-800
                            placeholder-gray-400
                            outline-none
                            transition
                            focus:border-pink-500
                            focus:ring-4
                            focus:ring-pink-100
                        "
                    >

                </div>



                {{-- =========================================
                    REMEMBER ME
                ========================================== --}}

                <div class="flex items-center">

                    <label
                        for="remember"
                        class="
                            inline-flex
                            items-center
                            cursor-pointer
                        "
                    >

                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            class="
                                w-4
                                h-4
                                rounded
                                border-gray-300
                                text-pink-600
                                focus:ring-pink-500
                            "
                        >

                        <span
                            class="
                                ml-2
                                text-sm
                                text-gray-500
                            "
                        >
                            Ingat saya
                        </span>

                    </label>

                </div>



                {{-- =========================================
                    LOGIN BUTTON
                ========================================== --}}

                <button
                    type="submit"
                    class="
                        w-full
                        inline-flex
                        items-center
                        justify-center
                        rounded-xl
                        bg-pink-600
                        px-5
                        py-3.5
                        text-sm
                        font-bold
                        text-white
                        shadow-sm
                        transition
                        duration-200
                        hover:bg-pink-700
                        hover:shadow-md
                        focus:outline-none
                        focus:ring-4
                        focus:ring-pink-200
                        active:scale-[0.99]
                    "
                >
                    Login
                </button>

            </form>



            {{-- =============================================
                REGISTER
            ============================================== --}}

            @if (Route::has('register'))

                <div class="mt-7 text-center">

                    <p class="text-sm text-gray-500">

                        Belum punya akun?

                        <a
                            href="{{ route('register') }}"
                            class="
                                font-semibold
                                text-pink-600
                                hover:text-pink-700
                            "
                        >
                            Daftar sekarang
                        </a>

                    </p>

                </div>

            @endif

        </div>



        {{-- =================================================
            FOOTER
        ================================================== --}}

        <p
            class="
                relative
                mt-7
                text-xs
                text-gray-400
            "
        >
            © {{ date('Y') }}
            <span class="text-pink-600 font-medium">
                BitebyAy
            </span>.
            All rights reserved.
        </p>

    </div>

</body>

</html>
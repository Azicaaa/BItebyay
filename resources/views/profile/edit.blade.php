@extends(auth()->user()->role === 'admin'
    ? 'layouts.admin'
    : 'layouts.customer')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- HEADER --}}

    <div class="mb-8">

        <p class="text-sm font-medium text-pink-600">
            Akun Admin
        </p>

        <h1 class="mt-1 text-3xl font-bold text-gray-800">
            Profil
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Kelola informasi akun dan keamanan BitebyAy.
        </p>

    </div>


    {{-- INFORMASI PROFIL --}}

    <div
        class="
            bg-white
            rounded-2xl
            border border-gray-200
            shadow-sm
            p-6
            lg:p-8
            mb-6
        "
    >

        <div class="mb-6">

            <h2 class="text-lg font-bold text-gray-800">
                Informasi Profil
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Perbarui nama dan alamat email akun admin.
            </p>

        </div>

        @include('profile.partials.update-profile-information-form')

    </div>


    {{-- PASSWORD --}}

    <div
        class="
            bg-white
            rounded-2xl
            border border-gray-200
            shadow-sm
            p-6
            lg:p-8
            mb-6
        "
    >

        <div class="mb-6">

            <h2 class="text-lg font-bold text-gray-800">
                Ubah Password
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Gunakan password yang kuat untuk menjaga keamanan akun.
            </p>

        </div>

        @include('profile.partials.update-password-form')

    </div>


    {{-- HAPUS AKUN --}}

    <div
        class="
            bg-white
            rounded-2xl
            border border-red-100
            shadow-sm
            p-6
            lg:p-8
        "
    >

        <div class="mb-6">

            <h2 class="text-lg font-bold text-gray-800">
                Hapus Akun
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Menghapus akun akan menghapus data akun secara permanen.
            </p>

        </div>

        @include('profile.partials.delete-user-form')

    </div>

</div>

@endsection
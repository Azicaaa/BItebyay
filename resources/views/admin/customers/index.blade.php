@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="mb-8">

        <p class="text-sm font-medium text-pink-600">
            Data Customer
        </p>

        <div
            class="
                mt-1
                flex
                flex-col
                sm:flex-row
                sm:items-end
                sm:justify-between
                gap-3
            "
        >

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Pelanggan
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Kelola dan lihat data pelanggan BitebyAy.
                </p>

            </div>

            <div
                class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    rounded-xl
                    bg-pink-50
                    text-pink-600
                    text-sm
                    font-semibold
                "
            >
                {{ $customers->total() }} pelanggan
            </div>

        </div>

    </div>


    {{-- =====================================================
        CUSTOMER LIST
    ====================================================== --}}

    <div
        class="
            bg-white
            rounded-2xl
            border border-gray-200
            shadow-sm
            overflow-hidden
        "
    >

        {{-- Header tabel --}}

        <div
            class="
                px-6
                py-5
                border-b border-gray-100
            "
        >

            <h2 class="text-base font-bold text-gray-800">
                Daftar Pelanggan
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Informasi pelanggan yang terdaftar di BitebyAy.
            </p>

        </div>


        {{-- =================================================
            TABLE
        ================================================== --}}

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">

                    <tr>

                        <th
                            class="
                                px-6
                                py-4
                                text-left
                                font-semibold
                                text-gray-600
                            "
                        >
                            Pelanggan
                        </th>

                        <th
                            class="
                                px-6
                                py-4
                                text-left
                                font-semibold
                                text-gray-600
                            "
                        >
                            Kontak
                        </th>

                        <th
                            class="
                                px-6
                                py-4
                                text-left
                                font-semibold
                                text-gray-600
                            "
                        >
                            Alamat
                        </th>

                        <th
                            class="
                                px-6
                                py-4
                                text-center
                                font-semibold
                                text-gray-600
                            "
                        >
                            Pesanan
                        </th>

                        <th
                            class="
                                px-6
                                py-4
                                text-right
                                font-semibold
                                text-gray-600
                            "
                        >
                            Terdaftar
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($customers as $customer)

                        <tr class="hover:bg-pink-50/30 transition">

                            {{-- =================================
                                CUSTOMER
                            ================================== --}}

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="
                                            w-10
                                            h-10
                                            rounded-full
                                            bg-pink-100
                                            text-pink-600
                                            flex
                                            items-center
                                            justify-center
                                            font-bold
                                            flex-shrink-0
                                        "
                                    >
                                        {{ strtoupper(
                                            substr(
                                                $customer->name ?? 'C',
                                                0,
                                                1
                                            )
                                        ) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p
                                            class="
                                                font-semibold
                                                text-gray-800
                                            "
                                        >
                                            {{ $customer->name }}
                                        </p>

                                        <p
                                            class="
                                                mt-0.5
                                                text-xs
                                                text-gray-400
                                            "
                                        >
                                            Customer
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- =================================
                                CONTACT
                            ================================== --}}

                            <td class="px-6 py-5">

                                <p class="text-sm text-gray-800">
                                    {{ $customer->email }}
                                </p>

                                @if ($customer->phone)

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            text-gray-500
                                        "
                                    >
                                        {{ $customer->phone }}
                                    </p>

                                @else

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            text-gray-400
                                        "
                                    >
                                        No. HP belum diisi
                                    </p>

                                @endif

                            </td>


                            {{-- =================================
                                ADDRESS
                            ================================== --}}

                            <td class="px-6 py-5">

                                @if ($customer->address)

                                    <p
                                        class="
                                            max-w-xs
                                            text-sm
                                            text-gray-700
                                            line-clamp-2
                                        "
                                    >
                                        {{ $customer->address }}
                                    </p>

                                @else

                                    <span
                                        class="
                                            text-xs
                                            text-gray-400
                                        "
                                    >
                                        Alamat belum diisi
                                    </span>

                                @endif

                            </td>


                            {{-- =================================
                                ORDERS
                            ================================== --}}

                            <td class="px-6 py-5 text-center">

                                <span
                                    class="
                                        inline-flex
                                        min-w-9
                                        items-center
                                        justify-center
                                        px-3
                                        py-1.5
                                        rounded-full
                                        bg-pink-50
                                        text-pink-600
                                        text-xs
                                        font-bold
                                    "
                                >
                                    {{ $customer->orders_count }}
                                </span>

                            </td>


                            {{-- =================================
                                REGISTERED
                            ================================== --}}

                            <td
                                class="
                                    px-6
                                    py-5
                                    text-right
                                "
                            >

                                <p
                                    class="
                                        text-sm
                                        text-gray-700
                                    "
                                >
                                    {{ $customer->created_at->format('d M Y') }}
                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-xs
                                        text-gray-400
                                    "
                                >
                                    {{ $customer->created_at->format('H:i') }}
                                </p>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="
                                    px-6
                                    py-16
                                    text-center
                                "
                            >

                                <div
                                    class="
                                        mx-auto
                                        w-14
                                        h-14
                                        rounded-full
                                        bg-pink-50
                                        flex
                                        items-center
                                        justify-center
                                        text-2xl
                                    "
                                >
                                    👤
                                </div>

                                <h3
                                    class="
                                        mt-4
                                        text-base
                                        font-bold
                                        text-gray-800
                                    "
                                >
                                    Belum ada pelanggan
                                </h3>

                                <p
                                    class="
                                        mt-1
                                        text-sm
                                        text-gray-500
                                    "
                                >
                                    Belum ada customer yang terdaftar.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =================================================
            PAGINATION
        ================================================== --}}

        @if ($customers->hasPages())

            <div
                class="
                    px-6
                    py-4
                    border-t
                    border-gray-100
                "
            >

                {{ $customers->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
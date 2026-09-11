@extends('layouts.admin')

@section('content')

<div class="py-4">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="mb-5">

            <div
                class="
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-4
                "
            >

                <div>

                    <p class="text-sm font-semibold text-pink-600">
                        Menu BitebyAy
                    </p>

                    <h1
                        class="
                            mt-0.5
                            text-3xl
                            font-bold
                            text-gray-800
                        "
                    >
                        Produk
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Kelola menu dessert, harga, stok, dan ketersediaannya.
                    </p>

                </div>


                {{-- Tambah Produk --}}

                <a
                    href="{{ route('admin.products.create') }}"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        px-5
                        py-3
                        rounded-xl
                        bg-pink-600
                        hover:bg-pink-700
                        text-white
                        text-sm
                        font-semibold
                        shadow-sm
                        transition
                        duration-200
                        whitespace-nowrap
                    "
                >
                    <span class="text-lg leading-none">+</span>
                    Tambah Produk
                </a>

            </div>

        </div>


        {{-- =====================================================
            NOTIFICATION
        ====================================================== --}}

        @if (session('success'))

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
                    font-medium
                    text-green-700
                "
            >
                {{ session('success') }}
            </div>

        @endif


        @if (session('error'))

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
                    font-medium
                    text-red-700
                "
            >
                {{ session('error') }}
            </div>

        @endif


        {{-- =====================================================
            CATEGORY MENU
            Tidak menggunakan kotak/container putih
        ====================================================== --}}

        <div
            class="
                sticky
                top-[80px]
                z-30
                py-3
                bg-gray-100/95
                backdrop-blur-sm
            "
        >

            <div
                id="categoryTabs"
                class="
                    flex
                    flex-wrap
                    items-center
                    gap-2
                "
            >

                {{-- SEMUA --}}

                <button
                    type="button"
                    data-category="all"
                    class="
                        category-tab
                        active
                        px-5
                        py-2.5
                        rounded-full
                        text-sm
                        font-semibold
                        bg-pink-600
                        text-white
                        shadow-sm
                        transition
                        duration-200
                    "
                >
                    Semua
                </button>


                {{-- KATEGORI --}}

                @foreach ($categories as $category)

                    @if ($category->products->count() > 0)

                        <button
                            type="button"
                            data-category="category-{{ $category->id }}"
                            class="
                                category-tab
                                px-5
                                py-2.5
                                rounded-full
                                text-sm
                                font-semibold
                                text-gray-600
                                bg-white
                                border
                                border-gray-200
                                hover:border-pink-200
                                hover:bg-pink-50
                                hover:text-pink-600
                                transition
                                duration-200
                            "
                        >
                            {{ $category->name }}
                        </button>

                    @endif

                @endforeach

            </div>

        </div>


        {{-- =====================================================
            PRODUCT SECTIONS
        ====================================================== --}}

        <div
            id="productSections"
            class="pt-3"
        >

            @forelse ($categories as $category)

                @if ($category->products->count() > 0)

                    <section
                        id="category-{{ $category->id }}"
                        class="
                            product-category
                            mb-10
                        "
                    >

                        {{-- =================================================
                            CATEGORY HEADER
                        ================================================== --}}

                        <div class="mb-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="
                                        w-10
                                        h-10
                                        rounded-xl
                                        bg-pink-50
                                        flex
                                        items-center
                                        justify-center
                                        text-lg
                                    "
                                >
                                    🍰
                                </div>

                                <div>

                                    <h2
                                        class="
                                            text-xl
                                            font-bold
                                            text-gray-800
                                        "
                                    >
                                        {{ $category->name }}
                                    </h2>

                                    <p class="mt-0.5 text-sm text-gray-500">
                                        {{ $category->products->count() }}
                                        produk
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            PRODUCT GRID
                        ================================================== --}}

                        <div
                            class="
                                grid
                                grid-cols-1
                                sm:grid-cols-2
                                lg:grid-cols-3
                                xl:grid-cols-4
                                gap-5
                            "
                        >

                            @foreach ($category->products as $product)

                                <div
                                    class="
                                        group
                                        bg-white
                                        rounded-2xl
                                        border
                                        border-gray-200
                                        shadow-sm
                                        overflow-hidden
                                        hover:shadow-lg
                                        transition-all
                                        duration-200
                                    "
                                >

                                    {{-- =================================
                                        PRODUCT IMAGE
                                    ================================== --}}

                                    <div
                                        class="
                                            relative
                                            h-44
                                            bg-gray-100
                                            overflow-hidden
                                        "
                                    >

                                        @if ($product->image)

                                            <img
                                                src="{{ asset('img/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="
                                                    w-full
                                                    h-full
                                                    object-cover
                                                    group-hover:scale-105
                                                    transition
                                                    duration-300
                                                "
                                            >

                                        @else

                                            <div
                                                class="
                                                    w-full
                                                    h-full
                                                    flex
                                                    flex-col
                                                    items-center
                                                    justify-center
                                                    text-gray-400
                                                "
                                            >

                                                <span class="text-3xl">
                                                    🍰
                                                </span>

                                                <span class="mt-2 text-xs">
                                                    Tidak ada gambar
                                                </span>

                                            </div>

                                        @endif


                                        {{-- STATUS --}}

                                        <div
                                            class="
                                                absolute
                                                top-3
                                                right-3
                                            "
                                        >

                                            @if (!$product->is_available)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        px-3
                                                        py-1.5
                                                        rounded-full
                                                        bg-white
                                                        text-gray-600
                                                        text-xs
                                                        font-semibold
                                                        shadow-sm
                                                    "
                                                >
                                                    Tidak tersedia
                                                </span>

                                            @elseif ($product->stock <= 0)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        px-3
                                                        py-1.5
                                                        rounded-full
                                                        bg-white
                                                        text-red-600
                                                        text-xs
                                                        font-semibold
                                                        shadow-sm
                                                    "
                                                >
                                                    Habis
                                                </span>

                                            @elseif ($product->stock <= 5)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        px-3
                                                        py-1.5
                                                        rounded-full
                                                        bg-white
                                                        text-yellow-600
                                                        text-xs
                                                        font-semibold
                                                        shadow-sm
                                                    "
                                                >
                                                    Stok menipis
                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        px-3
                                                        py-1.5
                                                        rounded-full
                                                        bg-white
                                                        text-green-600
                                                        text-xs
                                                        font-semibold
                                                        shadow-sm
                                                    "
                                                >
                                                    Tersedia
                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    {{-- =================================
                                        PRODUCT INFORMATION
                                    ================================== --}}

                                    <div class="p-5">

                                        <div
                                            class="
                                                flex
                                                items-start
                                                justify-between
                                                gap-3
                                            "
                                        >

                                            <h3
                                                class="
                                                    text-base
                                                    font-bold
                                                    text-gray-800
                                                    leading-snug
                                                "
                                            >
                                                {{ $product->name }}
                                            </h3>

                                        </div>


                                        {{-- PRICE --}}

                                        <p
                                            class="
                                                mt-2
                                                text-lg
                                                font-bold
                                                text-pink-600
                                            "
                                        >
                                            Rp{{ number_format(
                                                $product->price,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </p>


                                        {{-- DESCRIPTION --}}

                                        @if ($product->description)

                                            <p
                                                class="
                                                    mt-3
                                                    text-sm
                                                    text-gray-500
                                                    leading-relaxed
                                                    line-clamp-2
                                                "
                                            >
                                                {{ $product->description }}
                                            </p>

                                        @else

                                            <p
                                                class="
                                                    mt-3
                                                    text-sm
                                                    text-gray-400
                                                    italic
                                                "
                                            >
                                                Tidak ada deskripsi.
                                            </p>

                                        @endif


                                        {{-- =================================
                                            STOCK
                                        ================================== --}}

                                        <div
                                            class="
                                                mt-5
                                                flex
                                                items-center
                                                justify-between
                                                px-3
                                                py-2.5
                                                rounded-xl
                                                bg-gray-50
                                            "
                                        >

                                            <span
                                                class="
                                                    text-xs
                                                    text-gray-500
                                                "
                                            >
                                                Stok
                                            </span>


                                            @if ($product->stock <= 0)

                                                <span
                                                    class="
                                                        text-xs
                                                        font-bold
                                                        text-red-600
                                                    "
                                                >
                                                    Habis
                                                </span>

                                            @elseif ($product->stock <= 5)

                                                <span
                                                    class="
                                                        text-xs
                                                        font-bold
                                                        text-yellow-600
                                                    "
                                                >
                                                    {{ $product->stock }}
                                                    tersisa
                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        text-sm
                                                        font-bold
                                                        text-gray-700
                                                    "
                                                >
                                                    {{ $product->stock }}
                                                </span>

                                            @endif

                                        </div>


                                        {{-- =================================
                                            ACTION
                                        ================================== --}}

                                        <div
                                            class="
                                                mt-4
                                                grid
                                                grid-cols-2
                                                gap-2
                                            "
                                        >

                                            {{-- EDIT --}}

                                            <a
                                                href="{{ route(
                                                    'admin.products.edit',
                                                    $product
                                                ) }}"
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    px-3
                                                    py-2.5
                                                    rounded-xl
                                                    border
                                                    border-gray-200
                                                    bg-white
                                                    text-gray-700
                                                    text-xs
                                                    font-semibold
                                                    hover:bg-pink-50
                                                    hover:text-pink-600
                                                    hover:border-pink-200
                                                    transition
                                                "
                                            >
                                                Edit
                                            </a>


                                            {{-- HAPUS --}}

                                            <form
                                                action="{{ route(
                                                    'admin.products.destroy',
                                                    $product
                                                ) }}"
                                                method="POST"
                                                onsubmit="return confirm(
                                                    'Yakin ingin menghapus produk ini?'
                                                );"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="
                                                        w-full
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        px-3
                                                        py-2.5
                                                        rounded-xl
                                                        border
                                                        border-red-200
                                                        bg-white
                                                        text-red-600
                                                        text-xs
                                                        font-semibold
                                                        hover:bg-red-50
                                                        transition
                                                    "
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </section>

                @endif

            @empty

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}

                <div
                    class="
                        bg-white
                        rounded-2xl
                        border
                        border-gray-200
                        shadow-sm
                        px-6
                        py-16
                        text-center
                    "
                >

                    <div
                        class="
                            mx-auto
                            w-16
                            h-16
                            rounded-2xl
                            bg-pink-50
                            flex
                            items-center
                            justify-center
                            text-3xl
                        "
                    >
                        🍰
                    </div>


                    <h2
                        class="
                            mt-5
                            text-lg
                            font-bold
                            text-gray-800
                        "
                    >
                        Belum ada produk
                    </h2>


                    <p
                        class="
                            mt-2
                            text-sm
                            text-gray-500
                        "
                    >
                        Tambahkan produk dessert pertama BitebyAy.
                    </p>


                    <a
                        href="{{ route('admin.products.create') }}"
                        class="
                            mt-6
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-5
                            py-3
                            rounded-xl
                            bg-pink-600
                            hover:bg-pink-700
                            text-white
                            text-sm
                            font-semibold
                            transition
                        "
                    >
                        <span class="text-lg leading-none">+</span>
                        Tambah Produk
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- =========================================================
    CATEGORY FILTER
========================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const tabs = document.querySelectorAll('.category-tab');
    const sections = document.querySelectorAll('.product-category');


    tabs.forEach(function (tab) {

        tab.addEventListener('click', function () {

            const selectedCategory = this.dataset.category;


            // =================================================
            // RESET SEMUA TAB
            // =================================================

            tabs.forEach(function (item) {

                item.classList.remove(
                    'bg-pink-600',
                    'text-white',
                    'shadow-sm'
                );

                item.classList.add(
                    'bg-white',
                    'text-gray-600',
                    'border',
                    'border-gray-200'
                );

            });


            // =================================================
            // AKTIFKAN TAB TERPILIH
            // =================================================

            this.classList.remove(
                'bg-white',
                'text-gray-600',
                'border',
                'border-gray-200'
            );

            this.classList.add(
                'bg-pink-600',
                'text-white',
                'shadow-sm'
            );


            // =================================================
            // FILTER PRODUK
            // =================================================

            sections.forEach(function (section) {

                if (
                    selectedCategory === 'all' ||
                    section.id === selectedCategory
                ) {

                    section.classList.remove('hidden');

                } else {

                    section.classList.add('hidden');

                }

            });

            /*
            |--------------------------------------------------------------------------
            | TIDAK ADA AUTO SCROLL
            |--------------------------------------------------------------------------
            |
            | Sengaja tidak menggunakan window.scrollTo().
            | Posisi halaman tetap di tempat user mengklik kategori.
            |
            */

        });

    });

});

</script>

@endsection
@extends('layouts.admin')

@section('content')

<div class="py-8">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="mb-8">

            <div class="flex items-center gap-3">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        w-10
                        h-10
                        rounded-full
                        bg-white
                        border
                        border-gray-200
                        text-gray-600
                        hover:bg-pink-50
                        hover:text-pink-600
                        transition
                    "
                >
                    ←
                </a>

                <div>

                    <p class="text-sm font-medium text-pink-600">
                        Menu BitebyAy
                    </p>

                    <h1 class="mt-1 text-3xl font-bold text-gray-800">
                        Edit Produk
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Perbarui informasi produk {{ $product->name }}.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            VALIDATION ERROR
        ====================================================== --}}

        @if ($errors->any())

            <div
                class="
                    mb-6
                    rounded-xl
                    border border-red-200
                    bg-red-50
                    px-5 py-4
                "
            >

                <p class="text-sm font-semibold text-red-700">
                    Periksa kembali data yang dimasukkan.
                </p>

                <ul class="mt-2 space-y-1 text-sm text-red-600">

                    @foreach ($errors->all() as $error)

                        <li>
                            • {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
            FORM
        ====================================================== --}}

        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <div
                class="
                    bg-white
                    rounded-2xl
                    border border-gray-200
                    shadow-sm
                    overflow-hidden
                "
            >

                {{-- =================================================
                    INFORMASI PRODUK
                ================================================== --}}

                <div class="p-6 sm:p-8">

                    <div class="mb-6">

                        <h2 class="text-lg font-bold text-gray-800">
                            Informasi Produk
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Ubah informasi dessert sesuai kebutuhan.
                        </p>

                    </div>


                    <div class="space-y-6">


                        {{-- =================================================
                            NAMA
                        ================================================== --}}

                        <div>

                            <label
                                for="name"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Nama Produk
                                <span class="text-pink-600">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                required
                                class="
                                    mt-2
                                    w-full
                                    rounded-xl
                                    border border-gray-200
                                    bg-white
                                    px-4 py-3
                                    text-sm text-gray-800
                                    placeholder-gray-400
                                    focus:border-pink-500
                                    focus:ring-2
                                    focus:ring-pink-100
                                    outline-none
                                    transition
                                "
                            >

                        </div>


                        {{-- =================================================
                            KATEGORI
                        ================================================== --}}

                        <div>

                            <label
                                for="category_id"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Kategori
                                <span class="text-pink-600">*</span>
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                required
                                class="
                                    mt-2
                                    w-full
                                    rounded-xl
                                    border border-gray-200
                                    bg-white
                                    px-4 py-3
                                    text-sm text-gray-800
                                    focus:border-pink-500
                                    focus:ring-2
                                    focus:ring-pink-100
                                    outline-none
                                    transition
                                "
                            >

                                <option value="">
                                    Pilih kategori
                                </option>

                                @foreach ($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(
                                            old('category_id', $product->category_id) == $category->id
                                        )
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- =================================================
                            DESKRIPSI
                        ================================================== --}}

                        <div>

                            <label
                                for="description"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Deskripsi
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Jelaskan rasa atau isi dessert..."
                                class="
                                    mt-2
                                    w-full
                                    rounded-xl
                                    border border-gray-200
                                    bg-white
                                    px-4 py-3
                                    text-sm text-gray-800
                                    placeholder-gray-400
                                    focus:border-pink-500
                                    focus:ring-2
                                    focus:ring-pink-100
                                    outline-none
                                    transition
                                    resize-none
                                "
                            >{{ old('description', $product->description) }}</textarea>

                        </div>


                        {{-- =================================================
                            HARGA + STOK
                        ================================================== --}}

                        <div
                            class="
                                grid
                                grid-cols-1
                                sm:grid-cols-2
                                gap-5
                            "
                        >

                            {{-- Harga --}}

                            <div>

                                <label
                                    for="price"
                                    class="block text-sm font-semibold text-gray-700"
                                >
                                    Harga
                                    <span class="text-pink-600">*</span>
                                </label>

                                <div class="relative mt-2">

                                    <span
                                        class="
                                            absolute
                                            left-4
                                            top-1/2
                                            -translate-y-1/2
                                            text-sm
                                            text-gray-500
                                        "
                                    >
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        id="price"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
                                        min="0"
                                        step="100"
                                        required
                                        class="
                                            w-full
                                            rounded-xl
                                            border border-gray-200
                                            bg-white
                                            pl-11 pr-4
                                            py-3
                                            text-sm text-gray-800
                                            focus:border-pink-500
                                            focus:ring-2
                                            focus:ring-pink-100
                                            outline-none
                                            transition
                                        "
                                    >

                                </div>

                            </div>


                            {{-- Stok --}}

                            <div>

                                <label
                                    for="stock"
                                    class="block text-sm font-semibold text-gray-700"
                                >
                                    Stok
                                    <span class="text-pink-600">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="stock"
                                    name="stock"
                                    value="{{ old('stock', $product->stock) }}"
                                    min="0"
                                    required
                                    class="
                                        mt-2
                                        w-full
                                        rounded-xl
                                        border border-gray-200
                                        bg-white
                                        px-4 py-3
                                        text-sm text-gray-800
                                        focus:border-pink-500
                                        focus:ring-2
                                        focus:ring-pink-100
                                        outline-none
                                        transition
                                    "
                                >

                            </div>

                        </div>


                        {{-- =================================================
                            FOTO PRODUK
                        ================================================== --}}

                        <div>

                            <label
                                for="image"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Foto Produk
                            </label>


                            {{-- Foto lama --}}

                            @if ($product->image)

                                <div class="mt-3 mb-4">

                                    <p class="mb-2 text-xs text-gray-500">
                                        Foto saat ini
                                    </p>

                                    <div
                                        class="
                                            w-28 h-28
                                            rounded-2xl
                                            overflow-hidden
                                            bg-gray-100
                                            border border-gray-200
                                        "
                                    >

                                        <img
                                            src="{{ asset('img/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover"
                                        >

                                    </div>

                                </div>

                            @endif


                            {{-- Upload baru --}}

                            <div
                                class="
                                    rounded-xl
                                    border-2 border-dashed
                                    border-gray-200
                                    p-5
                                    hover:border-pink-300
                                    transition
                                "
                            >

                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="
                                        block
                                        w-full
                                        text-sm
                                        text-gray-500
                                        file:mr-4
                                        file:rounded-lg
                                        file:border-0
                                        file:bg-pink-50
                                        file:px-4
                                        file:py-2
                                        file:text-sm
                                        file:font-semibold
                                        file:text-pink-600
                                        hover:file:bg-pink-100
                                    "
                                >

                                <p class="mt-2 text-xs text-gray-400">
                                    Kosongkan jika tidak ingin mengganti foto.
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                </p>

                            </div>

                        </div>


                        {{-- =================================================
                            KETERSEDIAAN
                        ================================================== --}}

                        <div
                            class="
                                rounded-xl
                                border border-gray-200
                                bg-gray-50
                                px-5 py-4
                            "
                        >

                            <label
                                class="flex items-start gap-3 cursor-pointer"
                            >

                                <input
                                    type="checkbox"
                                    name="is_available"
                                    value="1"
                                    @checked(
                                        old('is_available', $product->is_available)
                                    )
                                    class="
                                        mt-1
                                        w-4 h-4
                                        rounded
                                        border-gray-300
                                        text-pink-600
                                        focus:ring-pink-500
                                    "
                                >

                                <span>

                                    <span
                                        class="
                                            block
                                            text-sm
                                            font-semibold
                                            text-gray-800
                                        "
                                    >
                                        Produk tersedia untuk dijual
                                    </span>

                                    <span
                                        class="
                                            block
                                            mt-1
                                            text-xs
                                            text-gray-500
                                        "
                                    >
                                        Nonaktifkan jika produk sedang tidak
                                        tersedia.
                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    FOOTER ACTION
                ================================================== --}}

                <div
                    class="
                        px-6 sm:px-8
                        py-5
                        bg-gray-50
                        border-t border-gray-100
                        flex
                        flex-col-reverse
                        sm:flex-row
                        sm:justify-end
                        gap-3
                    "
                >

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            px-5 py-3
                            rounded-xl
                            border border-gray-200
                            bg-white
                            text-gray-700
                            text-sm
                            font-semibold
                            hover:bg-gray-100
                            transition
                        "
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            px-6 py-3
                            rounded-xl
                            bg-pink-600
                            hover:bg-pink-700
                            text-white
                            text-sm
                            font-semibold
                            shadow-sm
                            transition
                        "
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk berdasarkan kategori.
     */
    public function index(): View
    {
        $categories = Category::with([
            'products' => function ($query) {
                $query->latest();
            }
        ])
        ->orderBy('name')
        ->get();

        return view(
            'admin.products.index',
            compact('categories')
        );
    }


    /**
     * Menampilkan form tambah produk.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'admin.products.create',
            compact('categories')
        );
    }


    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_available' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Status ketersediaan
        |--------------------------------------------------------------------------
        */

        $validated['is_available'] =
            $request->boolean('is_available');


        /*
        |--------------------------------------------------------------------------
        | Upload gambar
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $fileName =
                time() . '_' .
                uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('img'),
                $fileName
            );

            $validated['image'] = $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan produk
        |--------------------------------------------------------------------------
        */

        Product::create($validated);


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan form edit produk.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }


    /**
     * Memperbarui produk.
     */
    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_available' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Status ketersediaan
        |--------------------------------------------------------------------------
        */

        $validated['is_available'] =
            $request->boolean('is_available');


        /*
        |--------------------------------------------------------------------------
        | Upload gambar baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            /*
            | Hapus gambar lama.
            */

            if ($product->image) {

                $oldImage = public_path(
                    'img/' . $product->image
                );

                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }


            /*
            | Simpan gambar baru.
            */

            $image = $request->file('image');

            $fileName =
                time() . '_' .
                uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('img'),
                $fileName
            );

            $validated['image'] = $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | Update produk
        |--------------------------------------------------------------------------
        */

        $product->update($validated);


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil diperbarui.'
            );
    }


    /**
     * Menghapus produk.
     */
    public function destroy(Product $product): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Jangan hapus produk yang sudah pernah dipesan.
        |--------------------------------------------------------------------------
        */

        if ($product->orderItems()->exists()) {

            return back()->with(
                'error',
                'Produk tidak dapat dihapus karena sudah digunakan dalam pesanan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus gambar produk.
        |--------------------------------------------------------------------------
        */

        if ($product->image) {

            $imagePath = public_path(
                'img/' . $product->image
            );

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus produk.
        |--------------------------------------------------------------------------
        */

        $product->delete();


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil dihapus.'
            );
    }
}
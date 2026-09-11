<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil kategori
        |--------------------------------------------------------------------------
        */

        $mochi = Category::where('name', 'Mochi')->first();
        $cheese = Category::where('name', 'Cheese')->first();
        $strawberry = Category::where('name', 'Strawberry')->first();
        $cookies = Category::where('name', 'Cookies')->first();
        $tiramisu = Category::where('name', 'Tiramisu')->first();


        /*
        |--------------------------------------------------------------------------
        | Produk BitebyAy
        |--------------------------------------------------------------------------
        */

        $products = [

            // =========================
            // MOCHI
            // =========================

            [
                'category_id' => $mochi?->id,
                'name' => 'Mochi Cookies & Cream',
                'description' => 'Mochi lembut dengan isian wafer renyah dan cream cheese lembut yang creamy, menghadirkan perpaduan tekstur renyah dan lembut dengan rasa manis yang lezat di setiap gigitan..',
                'price' => 8000,
                'stock' => 0,
                'image' => 'cookiesandcream.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $mochi?->id,
                'name' => 'Mochi Caramellow',
                'description' => 'Mochi lembut dengan isian marshmallow yang manis dan kenyal serta cream cheese lembut yang creamy, menghadirkan perpaduan rasa manis dan gurih yang lembut di setiap gigitan..',
                'price' => 8000,
                'stock' => 0,
                'image' => 'caramellow (1).jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $mochi?->id,
                'name' => 'Mochi Blueberry',
                'description' => 'Mochi lembut dengan isian selay blueberry dengan cream cheese dan biskuit renyah..',
                'price' => 8000,
                'stock' => 0,
                'image' => 'blueberry .jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $mochi?->id,
                'name' => 'Mochi Chococheese',
                'description' => 'Mochi dengan isian cokelat lumer dan keju berlimpah.',
                'price' => 8000,
                'stock' => 0,
                'image' => 'chococheese.jpg',
                'is_available' => true,
            ],


            // =========================
            // CHEESE CAKE
            // =========================

            [
                'category_id' => $cheese?->id,
                'name' => 'Cheese Cake Mini Choco',
                'description' => '.',
                'price' => 13000,
                'stock' => 0,
                'image' => 'cheesecakeminichoco.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $cheese?->id,
                'name' => 'Cheese Cake Mini Lotusbiscoff',
                'description' => '.',
                'price' => 13000,
                'stock' => 0,
                'image' => 'cheesecakeminilotusbiscoff.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $strawberry?->id,
                'name' => 'Cheese Cake Mini Strawberry',
                'description' => '.',
                'price' => 13000,
                'stock' => 0,
                'image' => 'cheesecakeministrawberry .jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $mochi?->id,
                'name' => 'Mochi Cheese Cake Slice',
                'description' => '.',
                'price' => 13000,
                'stock' => 0,
                'image' => 'mochicheesecakeslice.jpg',
                'is_available' => true,
            ],


            // =========================
            // COOKIES
            // =========================

            [
                'category_id' => $cookies?->id,
                'name' => 'Cookies Original',
                'description' => '.',
                'price' => 13000,
                'stock' => 0,
                'image' => 'cookiesoriginal.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $cookies?->id,
                'name' => 'Cookies Oreo',
                'description' => '.',
                'price' => 13000,
                'stock' => 0,
                'image' => 'cookiesoreo.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $cookies?->id,
                'name' => 'Cookies Redvelvet Cheese',
                'description' => '.',
                'price' => 13000,
                'stock' => 0,
                'image' => 'cookiesredvelvetcheese.jpg',
                'is_available' => true,
            ],


            // =========================
            // TIRAMISU
            // =========================

            [
                'category_id' => $tiramisu?->id,
                'name' => 'Tiramisu Cake Original',
                'description' => '.',
                'price' => 22000,
                'stock' => 0,
                'image' => 'tiramisucakeoriginal.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $tiramisu?->id,
                'name' => 'Tiramisu Cake Chocolate',
                'description' => '.',
                'price' => 22000,
                'stock' => 0,
                'image' => 'tiramisucakechocolate.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $tiramisu?->id,
                'name' => 'Tiramisu Strawberry',
                'description' => '.',
                'price' => 22000,
                'stock' => 0,
                'image' => 'tiramisustrawbery.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $tiramisu?->id,
                'name' => 'Tiramisu Cake Matcha',
                'description' => '.',
                'price' => 22000,
                'stock' => 0,
                'image' => 'tiramisucakematcha.jpg',
                'is_available' => true,
            ],

            [
                'category_id' => $tiramisu?->id,
                'name' => 'Tiramisu Cake Cookies & Cream',
                'description' => '.',
                'price' => 22000,
                'stock' => 0,
                'image' => 'tiramisucakecookiesandcream.jpg',
                'is_available' => true,
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Simpan ke database
        |--------------------------------------------------------------------------
        */

        foreach ($products as $product) {

            Product::updateOrCreate(
                [
                    'name' => $product['name'],
                ],
                $product
            );

        }
    }
}
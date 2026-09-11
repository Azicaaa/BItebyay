<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mochi',
                'description' => 'Berbagai pilihan mochi dengan rasa yang lezat.',
            ],
            [
                'name' => 'Dessert',
                'description' => 'Pilihan dessert manis untuk menemani setiap momen.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
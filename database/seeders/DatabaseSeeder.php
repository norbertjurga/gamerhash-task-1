<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create();
        Product::factory(10)->create();

        $categories = Category::all();
        $products = Product::all();

        $categories->each(function ($category) use ($products) {
            $category->products()->attach(
                $products->random(rand(0, 3))->pluck('id')->toArray()
            );
        });
    }
}

<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_can_be_attached_to_categories()
    {
        $products = Product::factory(1)->create();
        $categories = Category::factory(3)->create();

        $product = $products->first(); 

        $product->categories()->sync($categories->pluck('id'));

        $this->assertDatabaseHas('category_product', [
            'category_id' => $categories->first()->id,
            'product_id' => $product->id
        ]);

        $this->assertCount(3, $product->categories);
    }
}

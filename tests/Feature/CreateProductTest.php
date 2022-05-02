<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_can_be_created()
    {

        $this->post('/products', [
            'name' => 'Product #1',
            'description' => 'Lorem Ipsum',
            'price' => 10.99
        ]);

        $this->assertCount(1, Product::all());

        $this->assertEquals('Product #1', Product::first()->name);
        $this->assertEquals('Lorem Ipsum', Product::first()->description);
        $this->assertEquals(10.99, Product::first()->price);
    }

    public function test_product_has_to_have_name()
    {
        $this->post('/products', [
            'price' => 10.99,
            'description' => 'Lorem Ipsum'
        ]);

        $this->assertCount(0, Product::all());
    }

    public function test_product_has_to_have_price()
    {

        $this->post('/products', [
            'name' => 'Lorem Ipsum',
            'description' => 'Lorem Ipsum'
        ]);
        
        $this->assertCount(0, Product::all());
    }
}

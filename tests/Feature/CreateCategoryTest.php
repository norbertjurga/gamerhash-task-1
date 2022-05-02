<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_created()
    {
        $this->post('/categories', [
            'name' => 'Test Category',
        ]);
        
        $this->assertCount(1, Category::all());

        $this->assertEquals('Test Category', Category::first()->name);

    }

    public function test_category_has_to_have_name()
    {
        $this->post('/products', [
            'name' => '',
        ]);
        $this->assertCount(0, Category::all());
    }
}

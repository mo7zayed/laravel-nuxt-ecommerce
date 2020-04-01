<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductIndexTest extends TestCase
{
    /**
     * test_it_returns_a_collection_of_products
     *
     * @return void
     */
    public function test_it_returns_a_collection_of_products()
    {
        $products = factory(Product::class, 5)->create();

        $response = $this->json('GET', 'api/products');

        $products->each(function ($product) use ($response) {
            $response->assertJsonFragment([
                'slug' => $product->slug,
            ]);
        });
    }
}

<?php

namespace Tests\Feature\Cart;

use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartIndexTest extends TestCase
{
    public function test_user_must_be_logged_in()
    {
        $response = $this->json('GET', 'api/cart');

        $response->assertStatus(401);
    }

    public function test_it_shows_products_in_user_cart()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1
            ]
        );

        $response = $this->jsonAs($user, 'GET', 'api/cart');

        $response->assertJsonFragment([
            'id' => $product->id
        ]);
    }
}

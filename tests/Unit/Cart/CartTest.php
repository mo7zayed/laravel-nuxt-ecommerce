<?php

namespace Tests\Unit\Cart;

use App\Cart\Cart;
use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class CartTest extends TestCase
{
    public function test_it_can_add_products_to_the_cart()
    {
        $user = factory(User::class)->create();

        $cart = new Cart($user);

        $product_variation = factory(ProductVariation::class)->create();

        $cart->add([
            [
                'id' => $product_variation->id,
                'quantity' => 1,
            ]
        ]);

        $this->assertEquals(1, $user->fresh()->cart()->count());
    }

    public function test_it_increments_quantity_when_adding_more_products()
    {
        $user = factory(User::class)->create()->fresh();

        $cart = new Cart($user);

        $product_variation = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $product_variation->id, 'quantity' => 1]
        ]);

        $cart = new Cart($user->fresh());

        $cart->add([
            ['id' => $product_variation->id,'quantity' => 1]
        ]);

        $this->assertEquals(2, $user->cart()->first()->pivot->quantity);
    }

    public function test_it_update_quantity_in_the_cart()
    {
        $user = factory(User::class)->create()->fresh();

        $cart = new Cart($user);

        $product_variation = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $product_variation->id, 'quantity' => 1]
        ]);

        $cart = new Cart($user->fresh());

        $cart->update($product_variation->id, 10);

        $this->assertEquals(10, $user->cart()->first()->pivot->quantity);
    }

    public function test_it_deletes_a_cart_item()
    {
        $user = factory(User::class)->create()->fresh();

        $cart = new Cart($user);

        $product_variation = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $product_variation->id, 'quantity' => 1]
        ]);

        $cart = new Cart($user->fresh());

        $cart->delete($product_variation->id);

        $this->assertEquals(0, $user->cart()->count());
    }

    public function test_it_can_empty_the_cart()
    {
        $user = factory(User::class)->create()->fresh();

        $cart = new Cart($user);

        $product_variation = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $product_variation->id, 'quantity' => 1]
        ]);

        $cart->empty();

        $this->assertEquals(0, $user->cart()->count());
    }
}

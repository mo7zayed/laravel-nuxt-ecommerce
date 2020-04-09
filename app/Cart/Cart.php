<?php

namespace App\Cart;

use App\Models\User;

class Cart
{
    /**
     * User instance
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * Class intitilzation
     *
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Add items to user cart.
     *
     * @param array $products
     *
     * @return void
     */
    public function add(array $data) : void
    {
        $this->user->cart()->syncWithoutDetaching($this->transform($data));
    }

    /**
     * Update cart item.
     *
     * @param integer $itemId
     * @param integer $quantity
     *
     * @return void
     */
    public function update(int $itemId, int $quantity) : void
    {
        $this->user->cart()->updateExistingPivot($itemId, [
            'quantity' => $quantity
        ]);
    }

    /**
     * Delete cart item.
     *
     * @param integer $itemId
     *
     * @return void
     */
    public function delete(int $itemId) : void
    {
        $this->user->cart()->detach($itemId);
    }

    /**
     * Empty the cart.
     *
     * @return void
     */
    public function empty() : void
    {
        $this->user->cart()->detach();
    }

    /**
     * Convert given data validated by \App\Http\Requests\Cart\CartStoreRequest to be used in syncWithoutDetaching eloquent method.
     *
     * @param array $data
     *
     * @return array
     */
    private function transform(array $data, $keyBy = 'id') : array
    {
        return collect($data)->keyBy($keyBy)->map(function ($item) {
            return [
                'quantity' => $item['quantity'] + $this->getCurrentQuantity($item['id']),
            ];
        })->toArray();
    }

    /**
     * Get product current quantity by it's id
     *
     * @param integer $itemId
     *
     * @return integer
     */
    private function getCurrentQuantity(int $itemId) : int
    {
        if ($product = $this->user->cart->where('id', $itemId)->first()) {
            return $product->pivot->quantity;
        }
        return 0;
    }
}

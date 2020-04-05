<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductResource;
use App\Helpers\Http\Respond;
use App\Models\Product;
use App\Scoping\Scopes\CategoryScope;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Product::withScopes($this->scopes())->paginate(10);

        return Respond::make(
            ProductIndexResource::collection($index)
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['variations.type', 'variations.stock', 'variations.product']);
        
        return Respond::make(
            new ProductResource($product)
        );
    }

    /**
     * Scopes That Will Be Used In Product.
     *
     * @return array
     */
    private function scopes() : array
    {
        return [
            'category' => new CategoryScope,
        ];
    }
}

<?php

namespace Tests\Unit\Models\Products;

use PHPUnit\Framework\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    public function test_it_uses_the_slug_as_route_key_name()
    {
        $this->assertEquals('slug', (new Product)->getRouteKeyName());
    }
}

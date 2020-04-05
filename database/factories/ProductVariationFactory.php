<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductVariation;
use Faker\Generator as Faker;

$factory->define(ProductVariation::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->name,
        'price' => rand(1000, 9999),
    ];
});

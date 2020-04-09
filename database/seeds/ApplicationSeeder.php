<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariationType;
use App\Models\Category;
use App\Models\ProductVariation;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 3)->create();

        // Commented to disable sub categories.
        // foreach (Category::all() as $category) {
        //     for ($i=0; $i < 3; $i++) {
        //         $category->appendNode(
        //             factory(Category::class)->create()
        //         );
        //     }
        // }

        factory(Product::class, 100)->create();

        factory(ProductVariationType::class, 3)->create();

        foreach (Product::all() as $key => $product) {
            $product->categories()->attach(
                Category::select('id')->inRandomOrder()->take(3)->get()->pluck('id')->toArray()
            );


            factory(ProductVariation::class)->create([
                'name' => 'v1',
                'product_id' => $product->id,
                'product_variation_type_id' => ProductVariationType::select('id')->inRandomOrder()->first()->id,
            ]);
            factory(ProductVariation::class)->create([
                'name' => 'v2',
                'product_id' => $product->id,
                'product_variation_type_id' => ProductVariationType::select('id')->inRandomOrder()->first()->id,
            ]);
            factory(ProductVariation::class)->create([
                'name' => 'v3',
                'product_id' => $product->id,
                'product_variation_type_id' => ProductVariationType::select('id')->inRandomOrder()->first()->id,
            ]);
            factory(ProductVariation::class)->create([
                'name' => 'v4',
                'product_id' => $product->id,
                'product_variation_type_id' => ProductVariationType::select('id')->inRandomOrder()->first()->id,
            ]);

            foreach ($product->variations as $v) {
                $v->stocks()->create([
                    'quantity' => 10,
                ]);
            }
        }
    }
}

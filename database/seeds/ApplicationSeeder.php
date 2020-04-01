<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

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

        foreach (Category::all() as $category) {
            for ($i=0; $i < 3; $i++) {
                $category->appendNode(
                    factory(Category::class)->create()
                );
            }
        }

        factory(Product::class, 100)->create();

        foreach (Product::all() as $product) {
            $product->categories()->attach(
                Category::select('id')->inRandomOrder()->take(3)->get()->pluck('id')->toArray()
            );
        }
    }
}

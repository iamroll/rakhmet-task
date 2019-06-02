<?php

use App\Model\Category;
use App\Model\Product;
use App\Model\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->delete();

        $products = Product::all();

        foreach ($products as $product) {
            ProductCategory::insert([
                'product_id' => $product->id,
                'category_id' => Category::inRandomOrder()->first()->id
            ]);
        }
    }
}

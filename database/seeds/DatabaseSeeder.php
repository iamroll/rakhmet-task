<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->delete();
        DB::table('products')->delete();
        DB::table('categories')->delete();
        DB::table('users')->delete();

        $this->call(CategorySeeder::class);
        factory(Product::class, 10)->create();
        $this->call(ProductCategorySeeder::class);
        $this->call(UserSeeder::class);
    }
}

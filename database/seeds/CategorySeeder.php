<?php

use App\Model\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Отдых', 'Развлечения', 'Спорт'
        ];

        foreach($categories as $category) {
            Category::insert([
                'title' => $category
            ]);
        }
    }
}

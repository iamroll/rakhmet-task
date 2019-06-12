<?php

namespace App\Http\Resources;

use App\Model\Category;
use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product_categories = $this
            ->productCategories()
            ->get();

        // Get categories of product.
        $categories = [];
        foreach ($product_categories as $product_category) {
            $category = Category::where('id', $product_category->category_id)
                ->first(['id', 'title']);
            if ($category == null) continue;
            $categories[] = $category;
        }

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'color' => $this->color,
            'price' => $this->price,
            'weight' => $this->weight,
            'categories' => $categories
        ];

        return $data;
    }
}

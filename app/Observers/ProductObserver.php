<?php

namespace App\Observers;

use App\Model\Product;
use App\Model\ProductCategory;

class ProductObserver
{
    public function updating(Product $product)
    {
        // Delete old product categories.
        ProductCategory::where('product_id', $product->id)->delete();
    }
}

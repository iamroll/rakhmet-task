<?php

namespace App\Repositories\ProductCategory;


interface ProductCategoryRepositoryInterface
{
    public function getProductIds($category_id);
}

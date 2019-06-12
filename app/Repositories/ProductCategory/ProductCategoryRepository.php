<?php

namespace App\Repositories\ProductCategory;

use App\Model\ProductCategory as Model;
use App\Repositories\CoreRepository;

class ProductCategoryRepository extends CoreRepository implements ProductCategoryRepositoryInterface
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get all products by category.
     *
     * @param $category_id
     * @return array
     */
    public function getProductIds($category_id)
    {
        $products = $this
            ->startConditions()
            ->where('category_id', $category_id)
            ->get(['product_id']);

        $result = [];

        foreach ($products as $product) {
            $result[] = $product->product_id;
        }

        return $result;
    }
}

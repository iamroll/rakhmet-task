<?php

namespace App\Repositories\Product;

use App\Model\Product as Model;
use App\Repositories\CoreRepository;

class ProductRepository extends CoreRepository implements ProductRepositoryInterface
{

    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get products by given ids.
     *
     * @param $product_ids
     * @return mixed
     */
    public function getProducts($product_ids)
    {
        $products = $this
            ->startConditions()
            ->whereIn('id', $product_ids)
            ->where('deleted_at', null)
            ->get();

        return $products;
    }

    /**
     * Get product for editing.
     *
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        $products = $this
            ->startConditions()
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        return $products;
    }

    /**
     * Get available products, return builder.
     *
     * @return mixed
     */
    public function getFilter()
    {
        $products = $this
            ->startConditions()
            ->where('deleted_at', null);

        return $products;
    }
}

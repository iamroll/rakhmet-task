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

    public function getProducts($product_ids)
    {
        $products = $this
            ->startConditions()
            ->whereIn('id', $product_ids)
            ->where('deleted_at', null)
            ->get();

        return $products;
    }

    public function getEdit($id)
    {
        $products = $this
            ->startConditions()
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        return $products;
    }

    public function getFilter()
    {
        $products = $this
            ->startConditions()
            ->where('deleted_at', null);

        return $products;
    }
}

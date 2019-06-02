<?php
/**
 * Created by PhpStorm.
 * User: 77056
 * Date: 31.05.2019
 * Time: 19:17
 */

namespace App\Repositories\Product;


interface ProductRepositoryInterface
{
    public function getProducts($product_ids);

    public function getEdit($id);

    public function getFilter();
}

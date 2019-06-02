<?php
/**
 * Created by PhpStorm.
 * User: 77056
 * Date: 31.05.2019
 * Time: 17:03
 */

namespace App\Repositories\Category;


interface CategoryRepositoryInterface
{
    public function getAll();

    public function getEdit($id);

}

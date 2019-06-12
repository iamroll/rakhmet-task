<?php

namespace App\Repositories\Category;

use App\Model\Category as Model;
use App\Repositories\CoreRepository;

class CategoryRepository extends CoreRepository implements CategoryRepositoryInterface
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get all available categories.
     *
     * @return mixed
     */
    public function getAll()
    {
        $categories = $this
            ->startConditions()
            ->where('deleted_at', null)
            ->get(['id', 'title']);

        return $categories;
    }

    /**
     * Get category for editing.
     *
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        $category = $this
            ->startConditions()
            ->where('deleted_at', null)
            ->where('id', $id)
            ->first();

        return $category;
    }
}

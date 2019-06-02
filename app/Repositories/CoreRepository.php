<?php

namespace App\Repositories;

abstract class CoreRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass ();

    protected function startConditions () {
        return clone $this->model;
    }
}

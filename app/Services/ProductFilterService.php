<?php
/**
 * Created by PhpStorm.
 * User: 77056
 * Date: 02.06.2019
 * Time: 13:58
 */

namespace App\Services;


class ProductFilterService
{
    protected $builder;
    protected $parameters;

    public function __construct($builder, $parameters)
    {
        $this->builder = $builder;
        $this->parameters = $parameters;
    }

    public function filter()
    {
        foreach ($this->parameters as $filter => $parameter) {
            if (method_exists($this, $filter)) {
                $this->$filter($parameter);
            }
        }

        return $this->builder;
    }

    public function price_from($value)
    {
        $this->builder->where('price', '>=', $value);
    }

    public function price_to($value)
    {
        $this->builder->where('price', '<=', $value);
    }

    public function color($value)
    {
        $this->builder->where('color', 'like', "%$value%");
    }

    public function weight_from($value)
    {
        $this->builder->where('weight', '>=', $value);
    }

    public function weight_to($value)
    {
        $this->builder->where('weight', '<=', $value);
    }

}

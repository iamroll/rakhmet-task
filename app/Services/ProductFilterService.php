<?php
/**
 * Created by PhpStorm.
 * User: 77056
 * Date: 02.06.2019
 * Time: 13:58
 */

namespace App\Services;


use Illuminate\Http\Request;

class ProductFilterService
{
    protected $builder;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter($builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
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

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title', 'description', 'price', 'color', 'weight'
    ];

    public function productCategories()
    {
        return $this->hasMany('App\Model\ProductCategory');
    }
}

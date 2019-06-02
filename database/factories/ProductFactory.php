<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Product as Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {

    $rules = [
        'title' => $faker->sentence(5),
        'description' => $faker->realText(rand(80, 600)),
        'price' => $faker->randomFloat('2', 10),
        'weight' => $faker->randomFloat(2, 1, 100),
        'color' => $faker->colorName,
    ];

    return $rules;
});

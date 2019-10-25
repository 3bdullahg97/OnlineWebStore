<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use App\SpecificationGroup;
use Faker\Generator as Faker;

$factory->define(SpecificationGroup::class, function (Faker $faker) {
    $categories = Category::all();

    return [
        'category_id' => $faker->randomElement($categories),
        'group_name'  => $faker->word,
    ];
});

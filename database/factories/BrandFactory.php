<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'logo' => $faker->imageUrl(500, 500, 'cats'),
        'color' => $faker->hexColor
    ];
});

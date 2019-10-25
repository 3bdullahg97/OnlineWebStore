<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Brand;
use App\Category;
use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class,
    function (Faker $faker) {
        $brands = Brand::all();
        $categories = Category::all();
        return [
            'name' => $faker->text(50),
            'price' => $faker->numberBetween(10, 2000),
            'brand_id' => $faker->randomElement($brands),
            'category_id' => $faker->randomElement($categories),
            'description' => $faker->text,
            'quantity' => $faker->numberBetween(2, 90)
        ];
    });

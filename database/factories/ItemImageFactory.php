<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Item;
use App\ItemImage;
use Faker\Generator as Faker;

$factory->define(ItemImage::class, function (Faker $faker) {
    $items = Item::all();
    return [
        'item_id' => $faker->randomElement($items),
        'image_path' => $faker->imageUrl(500, 500, 'cats')
    ];
});

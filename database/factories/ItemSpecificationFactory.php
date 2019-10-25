<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Item;
use App\ItemSpecification;
use App\Specification;
use Faker\Generator as Faker;

$factory->define(ItemSpecification::class, function (Faker $faker) {
    static $composite;
    $composite = $composite ? : [];

    $items = Item::all();
    $specifications = Specification::all();

    $specificationID = $faker->randomElement($specifications);

    $itemID = $faker->randomElement($items);
    while(in_array([$itemID, $specificationID], $composite))
        $itemID = $faker->randomElement($items);
    $composite[count($composite)] = [$itemID, $specificationID];

        return [
            'item_id' => $itemID,
            'specification_id' => $specificationID,
            'description'       => $faker->text
        ];


});

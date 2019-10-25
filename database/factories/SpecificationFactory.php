<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Specification;
use App\SpecificationGroup;
use Faker\Generator as Faker;

$factory->define(Specification::class, function (Faker $faker) {
    $groups = SpecificationGroup::all();
    return [
        'group_id' => $faker->randomElement($groups),
        'name'     => $faker->word,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hotel;
use Faker\Generator as Faker;

$factory->define(Hotel::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'stars' => $faker->unique(true)->numberBetween(1, 7),
        'address' => $faker->address
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hotel;
use App\Http\Controllers\HotelController;
use App\Rate;
use Faker\Generator as Faker;

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'from' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'to' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'adult_rate_per_night' => $faker->numerify('##'),
        'children_rate_per_night' => $faker->numerify('##'),
        'hotel_id' => factory(Hotel::class)
    ];
});

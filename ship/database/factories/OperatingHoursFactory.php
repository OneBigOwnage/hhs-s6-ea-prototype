<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\OperatingHours;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(OperatingHours::class, function (Faker $faker) {
    return [
        'hours'                => $faker->numberBetween(2500, 15000),
        'reading_date'         => Carbon::now()->subDays($faker->numberBetween(1, 5)),
    ];
});

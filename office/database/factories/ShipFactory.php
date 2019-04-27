<?php

/** @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Ship;
use Faker\Generator as Faker;

$factory->define(Ship::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameFemale,
    ];
});

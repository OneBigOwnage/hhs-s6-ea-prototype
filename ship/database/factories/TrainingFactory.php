<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Training;
use Faker\Generator as Faker;

$factory->define(Training::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'instructions' => $faker->sentences(10, true),
        'date' => $faker->dateTimeBetween('-20 days', '+20 days'),
        'is_done' => $faker->boolean,
        'feedback' => function ($training) use ($faker) {
            if (! $training['is_done']) {
                return null;
            }

            return $faker->sentences(3, true);
        },
    ];
});

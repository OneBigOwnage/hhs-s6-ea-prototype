<?php

/** @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Training;
use App\Ship;
use App\TrainingConcept;
use Faker\Generator as Faker;

$factory->define(Training::class, function (Faker $faker) {
    return [
        'ship_id' => factory(Ship::class)->lazy(),
        'concept_id' => factory(TrainingConcept::class)->lazy(),
        'title' => function ($training) {
            return TrainingConcept::find($training['concept_id'])->title;
        },
        'instructions' => function ($training) {
            return TrainingConcept::find($training['concept_id'])->instructions;
        },
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

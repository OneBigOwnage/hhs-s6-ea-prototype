<?php

/** @var $factory \Illuminate\Database\Eloquent\Factory */

use App\TrainingConcept;
use Faker\Generator as Faker;
use App\Training;

$factory->define(TrainingConcept::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'instructions' => $faker->sentences(10, true),
    ];
});

$factory->afterCreatingState(TrainingConcept::class, 'withInstances', function (TrainingConcept $concept, Faker $faker) {
    $amount = $faker->numberBetween(2, 6);

    for ($i = 0; $i < $amount; $i++) {
        factory(Training::class)->create([
            'concept_id' => $concept->id
        ]);
    }
});

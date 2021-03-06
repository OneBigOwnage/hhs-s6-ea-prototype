<?php

use Illuminate\Database\Seeder;
use App\TrainingConcept;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(TrainingConcept::class, 5)->state('withInstances')->create();
    }
}

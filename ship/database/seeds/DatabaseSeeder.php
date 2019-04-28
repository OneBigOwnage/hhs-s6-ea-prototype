<?php

use Illuminate\Database\Seeder;
use App\Training;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Training::class, 10)->create();
    }
}

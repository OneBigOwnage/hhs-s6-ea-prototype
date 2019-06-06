<?php

use App\Training;
use Illuminate\Database\Seeder;
use App\OperatingHours;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory(Training::class, 10)->create();

        $this->seedOperatingHours();
    }

    protected function seedOperatingHours()
    {
        $device = 'Engine front 1';

        foreach ([
            '05/18/2019' => 1200,
            '05/19/2019' => 1250,
            '05/20/2019' => 1300,
            '05/21/2019' => 1375,
            '05/22/2019' => 1400,
            '05/23/2019' => 1500,
        ] as $date => $hours) {
            OperatingHours::create([
                'hours'        => $hours ,
                'reading_date' => $date  ,
                'device'       => $device,
            ]);
        }


        $device = 'Engine front 2';

        foreach ([
            '05/14/2019' => 5500,
            '05/17/2019' => 5700,
            '05/20/2019' => 5900,
            '05/23/2019' => 6000,
            '05/26/2019' => 6100,
            '05/29/2019' => 6150,
        ] as $date => $hours) {
            OperatingHours::create([
                'hours'        => $hours ,
                'reading_date' => $date  ,
                'device'       => $device,
            ]);
        }


        $device = 'Engine back';

        foreach ([
            '06/01/2019' => 12000,
            '06/03/2019' => 12500,
            '06/05/2019' => 12700,
            '06/07/2019' => 12750,
            '06/09/2019' => 13000,
            '06/11/2019' => 13150,
        ] as $date => $hours) {
            OperatingHours::create([
                'hours'        => $hours ,
                'reading_date' => $date  ,
                'device'       => $device,
            ]);
        }
    }
}

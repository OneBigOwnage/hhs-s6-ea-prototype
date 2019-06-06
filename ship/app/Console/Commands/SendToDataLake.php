<?php

namespace App\Console\Commands;

use App\SendOperatingHoursTask;
use Illuminate\Console\Command;

class SendToDataLake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bigquery:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all pending operating hour records to the data lake instantly.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $task = new SendOperatingHoursTask();

        $task();
    }
}

<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

use Google\Cloud\BigQuery\BigQueryClient;

class SendOperatingHoursTask
{
    /**
     * The amount of records that have been inserted.
     *
     * @var int
     */
    protected $insertedRecordsCount = 0;

    /**
     * The cache key that is used to store the IDs of the
     * records that still need to be synced to BigQuery.
     *
     * @var string
     */
    public const CACHE_KEY = 'OPERATING_HOUR_IDS_TO_SYNC';

    /**
     * The __invoke method of this invokeable class.
     * Will retrieve all records that have to be sent to BigQuery, and send them.
     *
     * @return void
     */
    public function __invoke()
    {
        $records = $this->getRecords();

        if ($records->isEmpty()) {
            logger()->info('There are no operating hour records to send to the BigQuery data lake.');

            return;
        }

        foreach ($records as $record) {
            $this->sendToBigQuery($record);
        }

        logger()->info("Sent {$this->insertedRecordsCount} record(s) to the BigQuery data lake.");
    }

    /**
     * Retrieve all records that have to be synced to BigQuery from the database.
     *
     * @return Collection The list of records that have to be sent.
     */
    protected function getRecords()
    {
        $recordIDs = Cache::pull(static::CACHE_KEY, []);

        if (empty($recordIDs)) {
            return new Collection();
        }

        return OperatingHours::whereIn('id', $recordIDs)->get();
    }

    /**
     * Send a single OperatingHours record to BigQuery.
     *
     * @return void
     */
    protected function sendToBigQuery(OperatingHours $hours)
    {
        $rowData = [
            'device'       => $hours->device,
            'hours'        => $hours->hours,
            'reading_date' => Carbon::createFromFormat('m/d/Y', $hours->reading_date)->format('Y-m-d'),
        ];


        /** @var \Google\Cloud\BigQuery\InsertResponse $insertResponse */
        $insertResponse = app()
            ->make(BigQueryClient::class)
            ->dataset('test_dataset')
            ->table('operating_hours')
            ->insertRow($rowData);


        if ($insertResponse->isSuccessful()) {
            logger()->info("Operating hours record with ID {$hours->id} has been inserted into BigQuery");
            $this->insertedRecordsCount++;
        } else {
            logger()->error("Operating hours record with ID {$hours->id} could not be inserted into BigQuery. Additional logging below.");
            logger()->error(var_export($insertResponse->failedRows(), true));
        }
    }
}

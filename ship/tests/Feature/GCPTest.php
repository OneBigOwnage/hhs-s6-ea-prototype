<?php

namespace Tests\Feature;

use Tests\TestCase;
use Google\Cloud\BigQuery\BigQueryClient;

class GCPTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_values_from_google_cloud_platform()
    {
        $dataSetID = 'test_dataset';
        $tableID   = 'test_table';

        $client = app()->make(BigQueryClient::class);

        $tableRows = $client->dataset($dataSetID)->table($tableID)->rows();

        $this->assertEquals('Niek', $tableRows->current()['name']);
        $this->assertEquals(23    , $tableRows->current()['age']);
    }

    /** @test */
    public function it_can_send_data_to_big_query()
    {
        $client = app()->make(BigQueryClient::class);

        $result = $client->dataset('test_dataset')->table('operating_hours_test')->insertRow([
            'device'       => 'Test device',
            'hours'        => mt_rand(2500, 15000)    ,
            'reading_date' => '2019-06' ,
        ]);

        dump($result);

    }
}

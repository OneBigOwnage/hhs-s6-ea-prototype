<?php

namespace Tests\Feature;

use Tests\TestCase;
use Google\Cloud\BigQuery\BigQueryClient;

class GCPTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_values_from_google_cloud_platform()
    {
        $config = [
            'keyFilePath' => resource_path('GCPKey.json'),
            'projectId' => 'wise-vim-242413'
        ];

        $dataSetID = 'test_dataset';
        $tableID   = 'test_table';

        $client = new BigQueryClient($config);

        $tableRows = $client->dataset($dataSetID)->table($tableID)->rows();

        $this->assertEquals('Niek', $tableRows->current()['name']);
        $this->assertEquals(23    , $tableRows->current()['age']);
    }
}

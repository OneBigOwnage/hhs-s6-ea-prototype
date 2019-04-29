<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class CommunicationService implements CommunicationServiceContract
{
    const CACHE_PREFIX = 'communication';

    protected $client;

    public function __construct(Client $client) {
        $this->client= $client;
    }

    public function sync()
    {
        $this->receive();
        $this->send();
    }

    public function receive()
    {
        $identifier = env('SHIP_IDENTIFIER');

        $response = $this->client->get("/api/communication/{$identifier}");

        $trainingData = json_decode($response->getBody());

        foreach ($trainingData as $attributes) {
            if ($this->trainingExists($attributes->communication_id)) {
                continue;
            }

            Training::create([
                'communication_id' => $attributes->communication_id,
                'title'            => $attributes->title           ,
                'instructions'     => $attributes->instructions    ,
                'date'             => $attributes->date            ,
            ]);
        }
    }

    public function send()
    {
        $this->sendFeedback(
            $this->pending()
        );
    }

    protected function trainingExists($communicationID)
    {
        return Training::where('communication_id', $communicationID)->exists();
    }

    protected function pending()
    {
        return Training::where('is_done', true)->get();
    }

    protected function sendFeedback(Collection $trainings)
    {
        $identifier = env('SHIP_IDENTIFIER');

        $trainings->transform(function (Training $training) {
            return [
                'communication_id' => $training->communication_id,
                'feedback'         => $training->feedback
            ];
        });

        $this->client->post("/api/communication/{$identifier}", [
            'json' => [ 'trainings' => $trainings->toArray() ]
        ]);
    }

}

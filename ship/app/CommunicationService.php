<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class CommunicationService implements CommunicationServiceContract
{
    /**
     * The HTTP Client that is used to contact the office API.
     *
     * @var Client
     */
    protected $client;

    /**
     * The amount of new trainings that have been received
     * from the office in the current request cycle.
     *
     * @var int
     */
    protected static $receivedCount = 0;

    /**
     * The amount of trainings that have been sent
     * to the office in the current request cycle.
     *
     * @var int
     */
    protected static $sentCount = 0;

    /**
     * Create a new instance.
     *
     * @param  Client $client HTTP Client.
     *
     * @return void
     */
    public function __construct(Client $client) {
        $this->client= $client;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function sync()
    {
        $this->receive();
        $this->send();
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
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

            static::$receivedCount++;
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function send()
    {
        $this->sendFeedback(
            $this->pending()
        );
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function receivedCount()
    {
        return static::$receivedCount;
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function sentCount()
    {
        return static::$sentCount;
    }

    /**
     * Check if a training exists, with the given communication ID.
     *
     * @param  string $communicationID The unique communication ID used to check.
     *
     * @return bool True if a training with the given communication ID exists, false otherwise.
     */
    protected function trainingExists($communicationID)
    {
        return Training::where('communication_id', $communicationID)->exists();
    }

    /**
     * Retrieve all trainings that could potentially not be sent to the office yet.
     *
     * @return Collection|Training
     */
    protected function pending()
    {
        return Training::where('is_done', true)->get();
    }

    /**
     * Send a collection of completed trainings, including their feedback, to the office.
     *
     * @param  Collection $trainings The trainings that are to be sent.
     *
     * @return void
     */
    protected function sendFeedback(Collection $trainings)
    {
        $identifier = env('SHIP_IDENTIFIER');

        $trainings->transform(function (Training $training) {
            return [
                'communication_id' => $training->communication_id,
                'feedback'         => $training->feedback
            ];
        });

        $response = $this->client->post("/api/communication/{$identifier}", [
            'json' => [ 'trainings' => $trainings->toArray() ]
        ]);

        $response = json_decode($response->getBody());

        static::$sentCount = $response->newlyReceived;
    }
}

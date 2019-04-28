<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class CommunicationService implements CommunicationServiceContract
{
    /**
     * The cache key prefix.
     *
     * @var string
     */
    const CACHE_PREFIX = 'communication.';

    /**
     * Mark a training as ready for communication.
     *
     * @param  Ship     $ship
     * @param  Training $training
     *
     * @return void
     */
    public function add(Ship $ship, Training $training)
    {
        $pending = $this->getPending($ship);

        $pending->push($training->communication_id);

        $this->setPending($ship, $pending);
    }

    /**
     * Remove a training from the list of pending communications.
     *
     * @param  Ship     $ship
     * @param  Training $training
     *
     * @return void
     */
    public function remove(Ship $ship, Training $training)
    {
        $pending = $this->getPending($ship);

        $pending = $pending->reject(function ($ID) use ($training) {
            return $ID === $training->communication_id;
        });

        $this->setPending($ship, $pending);
    }

    /**
     * Retrieve communication IDs of all pending trainings.
     *
     * @param  Ship $ship
     *
     * @return Collection|string
     */
    public function getPending(Ship $ship)
    {
        return Cache::get($this->cacheKey($ship), collect());
    }

    /**
     * Set the list of pending communications.
     *
     * @param  Ship $ship
     * @param  Collection|string $IDs
     *
     * @return void
     */
    protected function setPending(Ship $ship, $IDs)
    {
        Cache::put($this->cacheKey($ship), $IDs->toArray());
    }

    protected function cacheKey(Ship $ship)
    {
        return static::CACHE_PREFIX . '.' . $ship->unique_identifier;
    }
}

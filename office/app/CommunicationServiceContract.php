<?php

namespace App;

use Illuminate\Support\Collection;

interface CommunicationServiceContract
{
    /**
     * Mark a training as ready for communication.
     *
     * @param  Ship     $ship
     * @param  Training $training
     *
     * @return void
     */
    public function add(Ship $ship, Training $training);

    /**
     * Remove a training from the list of pending communications.
     *
     * @param  Ship     $ship
     * @param  Training $training
     *
     * @return void
     */
    public function remove(Ship $ship, Training $training);

    /**
     * Retrieve communication IDs of all pending trainings.
     *
     * @param  Ship $ship
     *
     * @return Collection|string
     */
    public function getPending(Ship $ship);
}

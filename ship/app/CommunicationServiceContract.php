<?php

namespace App;

/**
 * @see \App\CommunicationService for the (only) implementation of this contract.
 */
interface CommunicationServiceContract
{
    /**
     * Synchronise with the office application,
     * in which both sending and receiving are performed.
     *
     * @return void
     */
    public function sync();

    /**
     * Fetch all open trainings from the office.
     *
     * @return void
     */
    public function receive();

    /**
     * Send all completed trainings to the office.
     *
     * @return void
     */
    public function send();

    /**
     * Get the amount of new trainings that have been received
     * from the office in the current request cycle.
     *
     * @return int
     */
    public function receivedCount();

    /**
     * Get the amount of trainings that have been sent
     * to the office in the current request cycle.
     *
     * @return int
     */
    public function sentCount();
}

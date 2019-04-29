<?php

namespace App;

interface CommunicationServiceContract
{
    public function sync();
    public function receive();
    public function send();

    public function receivedCount();
    public function sentCount();
}

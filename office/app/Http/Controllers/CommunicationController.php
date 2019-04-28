<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommunicationServiceContract;
use App\Ship;
use App\Training;

class CommunicationController extends Controller
{
    public function getPending($identifier, CommunicationServiceContract $service)
    {
        $ship = $this->ship($identifier);

        return $service->getPending($ship);
    }

    public function markSynced($identifier, Request $request, CommunicationServiceContract $service)
    {
        $ship = $this->ship($identifier);

        $trainings = Training::whereIn('communication_id', $request->training_ids)->get();

        foreach ($trainings as $training) {
            $service->remove($ship, $training);
        }
    }

    protected function ship($identifier)
    {
        return Ship::where('unique_identifier', $identifier)->firstOrFail();
    }
}

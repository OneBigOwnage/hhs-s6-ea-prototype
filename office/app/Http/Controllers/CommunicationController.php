<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ship;
use App\Training;

class CommunicationController extends Controller
{
    public function getPending($identifier)
    {
        $ship = $this->ship($identifier);

        return Training::where('is_done', false)->where('ship_id', $ship->id)->get()->toJson();
    }

    public function receiveFeedback($identifier, Request $request)
    {
        $ship = $this->ship($identifier);

        $incomingTrainings = collect($request->trainings);

        $trainingIDs = array_map(function ($training) {
            return $training['communication_id'];
        }, $request->trainings);

        $trainings = Training::where('ship_id', $ship->id)
            ->whereIn('communication_id', $trainingIDs)
            ->where('is_done', false)
            ->get();

        foreach ($trainings as $training) {
            $feedback = $incomingTrainings->firstWhere('communication_id', $training->communication_id)['feedback'];

            $training->is_done = true;
            $training->feedback = $feedback;

            $training->save();
        }
    }

    protected function ship($identifier)
    {
        return Ship::where('unique_identifier', $identifier)->firstOrFail();
    }
}

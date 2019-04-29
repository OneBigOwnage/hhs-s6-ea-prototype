<?php

namespace App\Http\Controllers;

use App\Ship;
use App\Training;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    /**
     * Retrieve all pending communications, for the ship with the given identifier.
     *
     * @param  string $identifier The unique identifier of the ship for which to receive open communications.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPending($identifier)
    {
        $ship = $this->ship($identifier);

        return Training::where('is_done', false)->where('ship_id', $ship->id)->get()->toJson();
    }

    /**
     * Receive and process incoming completed trainings.
     *
     * @param  string  $identifier The unique identifier of the ship.
     * @param  Request $request    The incoming request.
     *
     * @return \Illuminate\Http\Response
     */
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

        $newlyReceived = 0;

        foreach ($trainings as $training) {
            $feedback = $incomingTrainings->firstWhere('communication_id', $training->communication_id)['feedback'];

            $training->is_done = true;
            $training->feedback = $feedback;

            $training->save();

            $newlyReceived++;
        }

        return [ 'newlyReceived' => $newlyReceived];
    }

    /**
     * Retrieve a ship, by it's identifier.
     *
     * @param  string $identifier The unique identifier of the ship.
     *
     * @return Ship
     */
    protected function ship($identifier)
    {
        return Ship::where('unique_identifier', $identifier)->firstOrFail();
    }
}

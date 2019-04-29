<?php

namespace App\Http\Controllers;

use App\CommunicationServiceContract;
use Illuminate\Support\Facades\Cache;

class CommunicationController extends Controller
{
    /**
     * Synchronise the trainings with the office, then redirect back.
     *
     * @param CommunicationServiceContract $communicationService The communication service.
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(CommunicationServiceContract $communicationService)
    {
        $communicationService->sync();

        $sent     = $communicationService->sentCount();
        $received = $communicationService->receivedCount();

        if ($sent < 1 && $received < 1) {
            $message = 'No trainings were communicated.';
        } else {
            $message = "{$sent} training(s) were sent, {$received} training(s) were received.";
        }

        session()->flash('syncMessage', $message);

        Cache::pull('toSync');

        return redirect()->back();
    }
}

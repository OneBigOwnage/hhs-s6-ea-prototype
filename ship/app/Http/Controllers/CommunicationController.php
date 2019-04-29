<?php

namespace App\Http\Controllers;

use App\CommunicationServiceContract;
use Illuminate\Support\Facades\Cache;

class CommunicationController extends Controller
{
    public function sync(CommunicationServiceContract $service)
    {
        $service->sync();

        $sent     = $service->sentCount();
        $received = $service->receivedCount();

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

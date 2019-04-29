<?php

namespace App\Http\Controllers;

use App\CommunicationServiceContract;

class CommunicationController extends Controller
{
    public function sync(CommunicationServiceContract $service)
    {
        $service->sync();

        return redirect()->back();
    }
}

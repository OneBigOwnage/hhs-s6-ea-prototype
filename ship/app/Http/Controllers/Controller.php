<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $toSync = Cache::get('toSync', 0);

        return view('dashboard')
            ->with('toSync', $toSync);
    }
}

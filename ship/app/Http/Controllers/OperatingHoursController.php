<?php

namespace App\Http\Controllers;

use App\OperatingHours;
use Illuminate\Http\Request;

class OperatingHoursController extends Controller
{
    /**
     * Show a list of all operating hours.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hours = OperatingHours::query()->orderBy('device')->orderBy('hours')->get();

        return view('operating-hours.index')->with('operatingHours', $hours);
    }

    /**
     * Create a new operating hours record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $devices = [
            'Engine front 1',
            'Engine front 2',

            'Engine back',

            'Generator 1',
            'Generator 2',
        ];

        return view('operating-hours.create')->with('availableDevices', $devices);
    }

    /**
     * Persist a new operating hours record in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'device'       => 'required|string',
            'hours'        => 'required|int'   ,
            'reading_date' => 'required|date'  ,
        ]);

        OperatingHours::create($attributes);

        return redirect('/operating-hours');
    }
}

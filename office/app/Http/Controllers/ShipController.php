<?php

namespace App\Http\Controllers;

use App\Ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    /**
     * View a list of all ships.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ships.index')->with('ships',  Ship::all());
    }

    /**
     * Show the page where a new ship can be made.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ships.create');
    }

    /**
     * Persist a newly created ship.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Ship::create($attributes);

        return redirect('/ships');
    }
}

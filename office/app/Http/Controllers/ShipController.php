<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ship;

class ShipController extends Controller
{
    public function index()
    {
        return view('ships.index')->with('ships',  Ship::all());
    }

    public function create()
    {
        return view('ships.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Ship::create($attributes);

        return redirect('/ships');
    }
}

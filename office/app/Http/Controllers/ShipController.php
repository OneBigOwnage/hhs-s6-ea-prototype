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
}

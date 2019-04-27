<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrainingConcept;

class TrainingConceptController extends Controller
{
    public function index()
    {
        return view('concepts.index')->with('concepts',  TrainingConcept::all());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;

class TrainingController extends Controller
{
    public function index()
    {
        return view('trainings.index')->with('trainings',  Training::all());
    }
}

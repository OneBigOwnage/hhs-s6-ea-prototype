<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;

class TrainingController extends Controller
{
    public function index()
    {
        return view('trainings.index')->with('trainings', Training::all());
    }

    public function show(Training $training)
    {
        return view('trainings.show')->with('training', $training);
    }

    public function showComplete(Training $training)
    {
        return view('trainings.complete')->with('training', $training);
    }

    public function complete(Training $training, Request $request)
    {
        $training->feedback = $request->feedback;

        $training->is_done = true;

        $training->save();

        return redirect('/trainings');
    }
}

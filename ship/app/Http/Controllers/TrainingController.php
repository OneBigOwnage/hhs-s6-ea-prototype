<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrainingController extends Controller
{
    /**
     * Show a list of all trainings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainings.index')->with('trainings', Training::all());
    }

    /**
     * Show a single training.
     *
     * @param  Training $training The training that is to be shown.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        return view('trainings.show')->with('training', $training);
    }

    /**
     * Show the page where a training can be completed.
     *
     * @param Training $training The training that is to be completed.
     *
     * @return \Illuminate\Http\Response
     */
    public function showComplete(Training $training)
    {
        return view('trainings.complete')->with('training', $training);
    }

    /**
     * Mark the given training as complete, potentially with feedback.
     *
     * @param  Training $training The training that is to be completed.
     * @param  Request  $request  The incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete(Training $training, Request $request)
    {
        $training->feedback = $request->feedback;

        $training->is_done = true;

        $training->save();

        Cache::increment('toSync');

        return redirect('/trainings');
    }
}

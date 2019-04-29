<?php

namespace App\Http\Controllers;

use App\Ship;
use App\Training;
use App\TrainingConcept;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TrainingController extends Controller
{
    /**
     * Show a list of all trainings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainings.index')->with('trainings',  Training::all());
    }

    /**
     * Show the details of a single training.
     *
     * @param  Training $training The training that is to be shown.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        return view('trainings.show')
            ->with('training', $training);
    }

    /**
     * Show the page where a new training can be put on a barge.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $concepts = TrainingConcept::all();
        $ships = Ship::all();


        return view('trainings.create')
            ->with('ships', $ships)
            ->with('concepts', $concepts);
    }

    /**
     * Persist a newly created training instance.
     *
     * @param  Request $request The incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'ship_id'    => 'required|int|exists:ships,id'            ,
            'concept_id' => 'required|int|exists:training_concepts,id',
            'date'       => 'required|date'                           ,
        ]);

        $attributes['date'] = Carbon::createFromFormat('m/d/Y', $attributes['date'])->startOfDay();

        $concept = TrainingConcept::find($request->concept_id);

        $autoAttributes = [
            'title' => $concept->title,
            'instructions' => $concept->instructions,
        ];

        Training::create(array_merge($attributes, $autoAttributes));

        return redirect('/trainings');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use App\TrainingConcept;
use App\Ship;
use Illuminate\Support\Carbon;
use App\CommunicationServiceContract;

class TrainingController extends Controller
{
    public function index()
    {
        return view('trainings.index')->with('trainings',  Training::all());
    }

    public function create()
    {
        $concepts = TrainingConcept::all();
        $ships = Ship::all();


        return view('trainings.create')
            ->with('ships', $ships)
            ->with('concepts', $concepts);
    }

    public function store(Request $request, CommunicationServiceContract $service)
    {
        $attributes = $request->validate([
            'ship_id' => 'required|int|exists:ships,id',
            'concept_id' => 'required|int|exists:training_concepts,id',
            'date' => 'required|date',
        ]);

        $attributes['date'] = Carbon::createFromFormat('m/d/Y', $attributes['date'])->startOfDay();

        $concept = TrainingConcept::find($request->concept_id);

        $autoAttributes = [
            'title' => $concept->title,
            'instructions' => $concept->instructions,
        ];

        $training = Training::create(array_merge($attributes, $autoAttributes));
        $ship     = Ship::find($request->ship_id);

        $service->add($ship, $training);

        return redirect('/trainings');
    }
}

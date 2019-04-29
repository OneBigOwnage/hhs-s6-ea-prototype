<?php

namespace App\Http\Controllers;

use App\TrainingConcept;
use Illuminate\Http\Request;

class TrainingConceptController extends Controller
{
    /**
     * View a list of all trainings in the library.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('concepts.index')->with('concepts',  TrainingConcept::all());
    }

    /**
     * Show the page where a new training can be added to the library.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concepts.create');
    }

    /**
     * Persist a newly created training.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required'
        ]);

        TrainingConcept::create($attributes);

        return redirect('/concepts');
    }
}

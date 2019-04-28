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

    public function create()
    {
        return view('concepts.create');
    }

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

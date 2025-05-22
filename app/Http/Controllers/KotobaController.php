<?php

namespace App\Http\Controllers;

use App\Models\Kotoba;
use Illuminate\Http\Request;

class KotobaController extends Controller
{
    public function index()
    {
        $kotobas = Kotoba::all();
        return view('kotobas.index', compact('kotobas'));
    }

    public function create()
    {
        return view('kotobas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'japanese' => 'required',
            'reading' => 'required',
            'meaning' => 'required',
            'category' => 'required',
            'hint' => 'nullable',
            'level' => 'required',
        ]);

        Kotoba::create($request->all());
        return redirect()->route('kotobas.index')->with('success', 'Kotoba added!');
    }

    public function show(Kotoba $vocabulary)
    {
        return view('kotobas.show', compact('vocabulary'));
    }

    public function edit(Kotoba $vocabulary)
    {
        return view('kotobas.edit', compact('vocabulary'));
    }

    public function update(Request $request, Kotoba $vocabulary)
    {
        $request->validate([
            'word' => 'required',
            'reading' => 'required',
            'meaning' => 'required',
            'example' => 'nullable',
            'level' => 'required',
        ]);

        $vocabulary->update($request->all());
        return redirect()->route('kotobas.index')->with('success', 'Kotoba updated!');
    }

    public function destroy(Kotoba $vocabulary)
    {
        $vocabulary->delete();
        return redirect()->route('kotobas.index')->with('success', 'Kotoba deleted!');
    }
}

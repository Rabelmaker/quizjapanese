<?php

namespace App\Http\Controllers;

use App\Models\Kanji;
use Illuminate\Http\Request;

class KanjiController extends Controller
{
    public function index()
    {
        $kanjis = Kanji::all();
        return view('kanjis.index', compact('kanjis'));
    }

    public function create()
    {
        return view('kanjis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'character' => 'required',
            'onyomi' => 'nullable',
            'kunyomi' => 'nullable',
            'meaning' => 'required',
            'category' => 'required',
            'example' => 'nullable',
            'hint' => 'nullable',
            'level' => 'required',
        ]);

        Kanji::create($request->all());
        return redirect()->route('kanjis.index')->with('success', 'Kanji added!');
    }

    public function show(Kanji $kanji)
    {
        return view('kanjis.show', compact('kanji'));
    }

    public function edit(Kanji $kanji)
    {
        return view('kanjis.edit', compact('kanji'));
    }

    public function update(Request $request, Kanji $kanji)
    {
        $request->validate([
            'character' => 'required',
            'onyomi' => 'nullable',
            'kunyomi' => 'nullable',
            'meaning' => 'required',
            'category' => 'required',
            'example' => 'nullable',
            'hint' => 'nullable',
            'level' => 'required',
        ]);

        $kanji->update($request->all());
        return redirect()->route('kanjis.index')->with('success', 'Kanji updated!');
    }

    public function destroy(Kanji $kanji)
    {
        $kanji->delete();
        return redirect()->route('kanjis.index')->with('success', 'Kanji deleted!');
    }
}

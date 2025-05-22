<?php

namespace App\Http\Controllers;

use App\Models\kanji;
use App\Models\kotoba;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        // Ambil semua data
        $kanjis = Kanji::all();
        $kotobas = Kotoba::all();

        // Strukturkan berdasarkan level
        $structuredData = [
            'kanji' => $kanjis->groupBy('level')->map(function ($group) {
                return $group->map(function ($item) {
                    return [
                        'category'  => $item->category,
                        'character' => $item->character,
                        'hint'      => $item->hint,
                        'id'        => $item->id,
                        'kunyomi'   => $item->kunyomi,
                        'meaning'   => $item->meaning,
                        'onyomi'    => $item->onyomi,
                    ];
                })->values(); // values() untuk reset indeks array ke numerik
            }),
            'vocabulary' => $kotobas->groupBy('level')->map(function ($group) {
                return $group->map(function ($item) {
                    return [
                        'category'  => $item->category,
                        'meaning'   => $item->meaning,
                        'hint'      => $item->hint,
                        'id'        => $item->id,
                        'japanese'  => $item->japanese,
                        'reading'   => $item->reading,
                    ];
                })->values();
            }),
        ];

        // Kirim ke view
        return view('index', [
            'data' => $structuredData
        ]);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kanji extends Model
{
    protected $fillable = [
        'character',
        'onyomi',
        'kunyomi',
        'meaning',
        'hint',
        'category',
        'example',
        'level',
    ];
}

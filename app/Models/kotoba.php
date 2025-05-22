<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kotoba extends Model
{
    protected $fillable = [
        'word',
        'reading',
        'meaning',
        'example',
        'level',
    ];
}

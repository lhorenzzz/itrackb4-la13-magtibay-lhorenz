<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    protected $fillable = [
        'name',
        'genre',
        'platform',
        'year',
        'is_multiplayer',
    ];

    protected function casts(): array
    {
        return [
            'is_multiplayer' => 'boolean',
            'year' => 'integer',
        ];
    }
}

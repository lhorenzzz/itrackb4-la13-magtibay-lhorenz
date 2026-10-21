<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Game extends Model
{
    protected $fillable = [
        'name',
        'genre_id',
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

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

}

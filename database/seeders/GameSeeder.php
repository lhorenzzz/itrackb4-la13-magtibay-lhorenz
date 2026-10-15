<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
            'name' => 'The Legend of Zelda: Breath of the Wild',
            'genre' => 'Action-Adventure',
            'platform' => 'Nintendo Switch',
            'year' => 2017,
            'is_multiplayer' => true
        ]);

          Game::create([
            'name' => 'Elden Ring',
            'genre' => 'RPG',
            'platform' => 'PC',
            'year' => 2017,
            'is_multiplayer' => true
        ]);

          Game::create([
            'name' => 'Stardew Valley',
            'genre' => 'Simulation',
            'platform' => 'PC',
            'year' => 2016,
            'is_multiplayer' => false
        ]);

          Game::create([
            'name' => 'The Witcher 3: Wild Hunt',
            'genre' => 'RPG',
            'platform' => 'PC',
            'year' => 2015,
            'is_multiplayer' => false
        ]);

          Game::create([
            'name' => 'Call of Duty: Modern Warfare',
            'genre' => 'Shooter',
            'platform' => 'PC',
            'year' => 2019,
            'is_multiplayer' => true
        ]);
    }
}

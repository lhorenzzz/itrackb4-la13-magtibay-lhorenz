<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Genre;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actionAdventure = Genre::create(['name' => 'Action-Adventure']);
        $rpg             = Genre::create(['name' => 'RPG']);
        $simulation      = Genre::create(['name' => 'Simulation']);
        $shooter         = Genre::create(['name' => 'Shooter']);



        Game::create([
            'name' => 'The Legend of Zelda: Breath of the Wild',
            'genre_id' => $actionAdventure->id,
            'platform' => 'Nintendo Switch',
            'year' => 2017,
            'is_multiplayer' => true
        ]);

          Game::create([
            'name' => 'Elden Ring',
            'genre_id' => $rpg->id,
            'platform' => 'PC',
            'year' => 2017,
            'is_multiplayer' => true
        ]);

          Game::create([
            'name' => 'Stardew Valley',
            'genre_id' => $simulation->id,
            'platform' => 'PC',
            'year' => 2016,
            'is_multiplayer' => false
        ]);

          Game::create([
            'name' => 'The Witcher 3: Wild Hunt',
            'genre_id' => $rpg->id,
            'platform' => 'PC',
            'year' => 2015,
            'is_multiplayer' => false
        ]);

          Game::create([
            'name' => 'Call of Duty: Modern Warfare',
            'genre_id' => $shooter->id,
            'platform' => 'PC',
            'year' => 2019,
            'is_multiplayer' => true
        ]);
    }
}

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


        $moreGames = [
            ['name' => 'Zenless Zone Zero',        'genre' => $rpg,             'platform' => 'PC',              'year' => 2024, 'multi' => false],
            ['name' => 'Dark Souls',               'genre' => $actionAdventure, 'platform' => 'PC',              'year' => 2011, 'multi' => true],
            ['name' => 'Dark Souls 2',             'genre' => $actionAdventure, 'platform' => 'PC',              'year' => 2014, 'multi' => true],
            ['name' => 'Dark Souls 3',             'genre' => $actionAdventure, 'platform' => 'PlayStation',     'year' => 2016, 'multi' => true],
            ['name' => 'God of War',               'genre' => $actionAdventure, 'platform' => 'PlayStation',     'year' => 2018, 'multi' => false],
            ['name' => 'Hollow Knight',            'genre' => $actionAdventure, 'platform' => 'Nintendo Switch', 'year' => 2017, 'multi' => false],
            ['name' => 'Genshin Impact',           'genre' => $rpg,             'platform' => 'PC',              'year' => 2020, 'multi' => true],
            ['name' => 'Final Fantasy VII Remake', 'genre' => $rpg,             'platform' => 'PlayStation',     'year' => 2020, 'multi' => false],
            ['name' => 'Baldur\'s Gate 3',         'genre' => $rpg,             'platform' => 'PC',              'year' => 2023, 'multi' => true],
            ['name' => 'Pokemon Scarlet',          'genre' => $rpg,             'platform' => 'Nintendo Switch', 'year' => 2022, 'multi' => true],
            ['name' => 'Animal Crossing',          'genre' => $simulation,      'platform' => 'Nintendo Switch', 'year' => 2020, 'multi' => true],
            ['name' => 'The Sims 4',               'genre' => $simulation,      'platform' => 'PC',              'year' => 2014, 'multi' => false],
            ['name' => 'Euro Truck Simulator 2',   'genre' => $simulation,      'platform' => 'PC',              'year' => 2012, 'multi' => true],
            ['name' => 'Valorant',                 'genre' => $shooter,         'platform' => 'PC',              'year' => 2020, 'multi' => true],
            ['name' => 'Halo Infinite',            'genre' => $shooter,         'platform' => 'Xbox',            'year' => 2021, 'multi' => true],
            ['name' => 'Doom Eternal',             'genre' => $shooter,         'platform' => 'Xbox',            'year' => 2020, 'multi' => false],
        ];

        foreach ($moreGames as $row) {
            Game::create([
                'name'           => $row['name'],
                'genre_id'       => $row['genre']->id,   // kunin ang id ng genre na hawak ng variable
                'platform'       => $row['platform'],
                'year'           => $row['year'],
                'is_multiplayer' => $row['multi'],
            ]);
        }
    }
}

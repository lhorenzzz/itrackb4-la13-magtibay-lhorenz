<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    private function games()
    {
        $path = storage_path('app/games.json');

        return json_decode(file_get_contents($path), true);
    }

    private function saveGames(array $games)
    {
        file_put_contents(
            storage_path('app/games.json'),
            json_encode($games, JSON_PRETTY_PRINT)
        );
    }

    public function filter($value = null)
    {
        if (is_null($value)) {
            return redirect()->route('games.index');
        }
        return redirect()->route('games.index', ['genre' => $value]);
    }

    public function index(Request $request)
    //i still have the Request since im still using the filter buttons if its remove it will not work
    //so that we can read the ?genre parameter if remove, it will say missing $genre on view
    {

        //take genre on the url
        $genre = $request->query('genre', '');
        $platform = $request->query('platform', '');

        //search on games table
        $query = Game::query();

        //if genre then only genre
        if ($genre != '') {
            $query->where('genre', $genre);
        }

        //if platform then only platform
        if ($platform != '') {
            $query->where('platform', $platform);
        }

        //get all games in the table
        $games = $query->get();

        return view('games.index', [
            'games' => $games,
            'genre' => $genre,
            'platform' => $platform,
            'genres' => ['Action-Adventure', 'RPG', 'Simulation', 'Shooter'],
            'platforms' => ['PC', 'PlayStation', 'Xbox', 'Nintendo Switch'],
        ]);

        // $games = Game::all();
        // return view('games.index', compact('games'));

        // $games = $this->games();

        // $genre = $request->query('genre', 'all');
        // $platform = $request->query('platform', 'all');
        // $year = $request->query('year', 'all');
        // $is_multiplayer = $request->query('is_multiplayer', 'all');

        // $filtered = collect($games)->filter(function ($game) use ($genre, $platform, $year, $is_multiplayer) {
        //     $matchGenre = $genre == 'all' || $game['genre'] == $genre;
        //     $matchPlatform = $platform == 'all' || $game['platform'] == $platform;
        //     $year = $year == 'all' || $game['year'] == $year;
        //     $is_multiplayer = $is_multiplayer == 'all' || $game['is_multiplayer'] == ($is_multiplayer === 'true');

        //     return $matchGenre && $matchPlatform && $year && $is_multiplayer;
        // });

        // return view('games.index', [
        //     'games' => $filtered,
        //     'genre' => $genre ?? '',
        //     'platform' => $platform ?? '',
        //     'genres' => collect($games)->pluck('genre')->unique()->values(),
        //     'platforms' => collect($games)->pluck('platform')->unique()->values(),
        //     'year' => collect($games)->pluck('year')->unique()->values(),
        //     'is_multiplayer' => collect($games)->pluck('is_multiplayer')->unique()->values(),
        // ]);
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'genre' => 'required|in:Action-Adventure,RPG,Simulation,Shooter',
            'platform' => 'required|in:PC,PlayStation,Xbox,Nintendo Switch',
            'year' => 'required|integer|min:1970|max:' . date('Y'),
            'is_multiplayer' => 'required|boolean',

        ]);

        $games = $this->games();
        $newId = count($games) + 1;
        $games[$newId] = [
            'id' => $newId,
            'name' => $validatedData['name'],
            'genre' => $validatedData['genre'],
            'platform' => $validatedData['platform'],
            'year' => $validatedData['year'],
            'is_multiplayer' => $validatedData['is_multiplayer'],
        ];

        $this->saveGames($games);

        return redirect()->route('games.index')->with('success', 'Game created successfully!');
    }


    public function show($id)
    {
        $game = Game::findOrFail($id);
        return view('games.show', compact('game'));

        // $games = $this->games();

        // if (!isset($games[$id])) {
        //     abort(404);
        // }
        // return view('games.show', ['game' => $games[$id]]);
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function featured()
    {
       $game = Game::findOrFail(1);
       return view('games.show', compact('game'));
    }

    public function favorite()
    {
        $game = Game::findOrFail(2);
        return view('games.show', compact('game'));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


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

        $genres = Genre::all();

        //take genre on the url
        $genre = $request->query('genre', '');
        $platform = $request->query('platform', '');

        $sort = $request->query('sort', 'name');
        $allowedSorts = ['name', 'year', 'platform'];
        $search = $request->query('search');
        $multi = $request->query('is_multiplayer');

        //search on games table
        $query = Game::with('genre');

        //if genre then only genre
        if ($genre) {
            $query = $query->where('genre_id', $genre);
        }

        //if platform then only platform
        if ($platform) {
            $query = $query->where('platform', $platform);
        }

        if (! in_array($sort, $allowedSorts)) {
            $sort = 'name';
        }

        // Search: hanapin ang text sa loob ng name column. like %...% = "naglalaman ng"
        if ($search) {
            $query = $query->where('name', 'like', "%{$search}%");
        }

        // TRAP: ang '0' ay falsy sa PHP, kaya hindi pwede ang simpleng if ($multi).
        // Kaya tinitingnan natin kung may laman talaga (hindi null at hindi blangko).
        if ($multi !== null && $multi !== '') {
            $query = $query->where('is_multiplayer', $multi);
        }

        $query = $query->orderBy($sort);
        $games = $query->paginate(8)->withQueryString();

        return view('games.index', [
            'games' => $games,
            'genre' => $genre,
            'platform' => $platform,
            'genres' => $genres,
            'platforms' => ['PC', 'PlayStation', 'Xbox', 'Nintendo Switch'],
        ]);
    }

    public function create()
    {
        return view('games.create', ['genres' => Genre::all(),]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'genre_id' => 'required|exists:genres,id',
            'platform' => 'required|in:PC,PlayStation,Xbox,Nintendo Switch',
            'year' => 'required|integer|min:1970|max:' . date('Y'),
            'is_multiplayer' => 'required|boolean',
        ]);

        $game = Game::create($validated);

        Log::info('Game saved', [
            'id' => $game->id,
        ]);

        return redirect()->route('games.index')->with('success', 'Game created successfully!');
    }



    public function show(Game $game)
    {
        // $game = Game::findOrFail($id);
        return view('games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        $genres = Genre::all();
        return view('games.edit', compact('game', 'genres'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'genre_id' => 'required|exists:genres,id',
            'platform' => 'required|in:PC,PlayStation,Xbox,Nintendo Switch',
            'year' => 'required|integer|min:1970|max:' . date('Y'),
            'is_multiplayer' => 'required|boolean',
        ]);

        $game->update($validated);

        return redirect()->route('games.index')->with('success', 'Game updated successfully!');
    }


    public function destroy(Game $game)
    {
        abort_if($game->genre->games()->count() === 1, 403, 'Cannot delete a genre that has more than one game.');
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully!');
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

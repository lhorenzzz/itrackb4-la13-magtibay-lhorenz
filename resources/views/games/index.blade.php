@extends('layouts.app')

@section('title', 'Game Recommendations')

@section('content')
    @include('partials._nav')
    <h2 class="mb-3">List of Games</h2>

    {{-- Badge: sinasabi kung anong filter ang aktibo --}}
    <div class="mb-3">
        @if ($genre == '' && $platform == '')
            <span class="badge bg-secondary">Showing all games</span>
        @else
            <span class="badge bg-primary">
                @if ($genre != '')
                    {{-- id ang laman ng $genre, kaya hanapin ang pangalan sa listahan --}}
                    {{ $genres->firstWhere('id', $genre)?->name }}
                @else
                    any genre
                @endif
                ,
                @if ($platform != '')
                    {{ $platform }}
                @else
                    any platform
                @endif
            </span>
            {{-- Tanggalin ang dalawang filter --}}
            <a href="{{ route('games.index') }}" class="btn btn-sm btn-outline-secondary ms-2">Clear Filter</a>
        @endif

        <a href="{{ route('games.create') }}" class="btn btn-sm btn-outline-secondary ms-2">Add Game</a>
    </div>

    {{-- method="GET" = napupunta sa URL ang mga pinili, kaya pwedeng i-bookmark (H1) --}}
    <form method="GET" action="{{ route('games.index') }}" class="row g-2 mb-3">

        {{-- Search box. request('search') = ibinabalik ang tinype pagkatapos mag-reload (H5) --}}
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name"
                value="{{ request('search') }}">
        </div>

        {{-- Genre dropdown. Ang value ay id, ang text ay name. --}}
        <div class="col-md-3">
            <select name="genre" class="form-select">
                <option value="">All genres</option>
                @foreach ($genres as $g)
                    <option value="{{ $g->id }}" @selected(request('genre') == $g->id)>{{ $g->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Boolean dropdown. Gamit ang === '1' at '0' (string) para magkaiba ang "No" at "Any" --}}
        <div class="col-md-3">
            <select name="is_multiplayer" class="form-select">
                <option value="">Any</option>
                <option value="1" @selected(request('is_multiplayer') === '1')>Multiplayer</option>
                <option value="0" @selected(request('is_multiplayer') === '0')>Single-player</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Apply</button>
            {{-- Clear = bumabalik sa list na walang kahit anong query (H7) --}}
            <a href="{{ route('games.index') }}" class="btn btn-outline-secondary">Clear</a>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Genre</th>
                <th>Platform</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($games as $game)
                <tr>
                    <td>
                        <a href="{{ route('games.show', ['game' => $game->id]) }}">
                            {{ $loop->iteration }}
                        </a>
                    </td>
                    <td>{{ $game->name }}</td>
                    <td>
                        {{-- genre_id para sa link, genre->name para sa lalabas (walang panaklong) --}}
                        <a href="{{ route('games.index', ['genre' => $game->genre_id, 'platform' => $platform]) }}">
                            {{ $game->genre->name }}
                        </a>
                    </td>
                    <td>{{ $game->platform }}</td>
                    <td>{{ $game->year }}</td>
                    <td>
                        {{-- d-flex gap-1 = ilalagay nang magkatabi ang Edit at Delete, may konting espasyo --}}
                        <div class="d-flex gap-1">

                            {{-- route('games.edit', $game) = papunta sa /games/{id}/edit. $game ang laro sa row na ito.
                            Ito ay GET na link, kaya OK lang ang <a>. --}}
                                <a href="{{ route('games.edit', $game) }}" class="btn btn-warning btn-sm">Edit</a>

                                {{-- Delete: form na may @method('DELETE'), kasi hindi kayang magpadala ng DELETE ng link --}}
                                <form action="{{ route('games.destroy', $game) }}" method="POST"
                                    onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No Games Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $games->links() }}

@endsection

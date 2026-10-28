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

    {{-- Genre buttons: dala ang kasalukuyang platform para hindi mawala --}}
    <div class="mb-2">
        <strong>Genre:</strong>
        <a href="{{ route('games.index', ['genre' => '', 'platform' => $platform]) }}"
            class="btn btn-sm btn-outline-primary">All</a>
        @foreach ($genres as $g)
            <a href="{{ route('games.index', ['genre' => $g->id, 'platform' => $platform]) }}"
                class="btn btn-sm btn-outline-primary">{{ $g->name }}</a>
        @endforeach
    </div>

    {{-- Platform buttons: dala ang kasalukuyang genre --}}
    <div class="mb-3">
        <strong>Platform:</strong>
        <a href="{{ route('games.index', ['genre' => $genre, 'platform' => '']) }}"
            class="btn btn-sm btn-outline-secondary">All</a>
        @foreach ($platforms as $p)
            <a href="{{ route('games.index', ['genre' => $genre, 'platform' => $p]) }}"
                class="btn btn-sm btn-outline-secondary">{{ $p }}</a>
        @endforeach
    </div>

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
                        <form action="{{ route('games.destroy', $game) }}" method="POST"
                            onsubmit="return confirm('Delete this record?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No Games Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p>Queries: {{ count(\Illuminate\Support\Facades\DB::getQueryLog()) }}</p>
@endsection

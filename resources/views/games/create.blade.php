@extends('layouts.app')

@section('title', 'Add New Game')

@section('content')
    @include('partials._nav')

    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-4">Add a New Game</h3>

            <form action="{{ route('games.store') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Game Name</label>
                    <input type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Genre: galing na sa genres table. value = id, text = name --}}
                <div class="mb-3">
                    <label for="genre_id" class="form-label">Genre</label>
                    <select name="genre_id" id="genre_id"
                        class="form-select @error('genre_id') is-invalid @enderror">
                        <option value="">Select Genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}"
                                @selected(old('genre_id') == $genre->id)
                            >{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Platform --}}
                <div class="mb-3">
                    <label for="platform" class="form-label">Platform</label>
                    <select name="platform" id="platform"
                        class="form-select @error('platform') is-invalid @enderror">
                        <option value="">Select Platform</option>
                        <option value="PC" @selected(old('platform') == 'PC')>PC</option>
                        <option value="PlayStation" @selected(old('platform') == 'PlayStation')>PlayStation</option>
                        <option value="Xbox" @selected(old('platform') == 'Xbox')>Xbox</option>
                        <option value="Nintendo Switch" @selected(old('platform') == 'Nintendo Switch')>Nintendo Switch</option>
                    </select>
                    @error('platform')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Year --}}
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number"
                        class="form-control @error('year') is-invalid @enderror"
                        id="year" name="year" value="{{ old('year') }}">
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Multiplayer: 1 = Yes, 0 = No (hindi "true" o "false") --}}
                <div class="mb-3">
                    <label for="is_multiplayer" class="form-label">Multiplayer?</label>
                    <select name="is_multiplayer" id="is_multiplayer"
                        class="form-select @error('is_multiplayer') is-invalid @enderror">
                        <option value="">Select</option>
                        <option value="1" @selected(old('is_multiplayer') === '1')>Yes</option>
                        <option value="0" @selected(old('is_multiplayer') === '0')>No</option>
                    </select>
                    @error('is_multiplayer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Add Game</button>
                <a class="btn btn-secondary" href="{{ route('games.index') }}">Back to the list</a>
            </form>
        </div>
    </div>
@endsection

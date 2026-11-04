@extends('layouts.app')

@section('title', 'Something went wrong')

@section('content')
    <style>
        .err-wrap {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem 1rem;
        }
        .err-code {
            font-size: clamp(5rem, 18vw, 10rem);
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #dc3545, #fd7e14);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .err-title {
            margin-top: 0.5rem;
            font-size: 1.75rem;
            font-weight: 700;
        }
        .err-text {
            color: #6c757d;
            max-width: 30rem;
            margin: 0.5rem 0 1.5rem;
        }
        .err-btn {
            display: inline-block;
            padding: 0.7rem 1.6rem;
            border-radius: 999px;
            background: linear-gradient(135deg, #dc3545, #fd7e14);
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(220, 53, 69, 0.35);
        }
        .err-btn:hover { color: #fff; }
    </style>

    <div class="err-wrap">
        <div class="err-code">500</div>
        <h1 class="err-title">Something went wrong on our side</h1>
        <p class="err-text">
            Sorry, this is our mistake, not yours. The problem has been recorded
            and we will look into it. Please try again in a little while.
        </p>
        <a class="err-btn" href="{{ route('games.index') }}">Back to the list</a>
    </div>
@endsection

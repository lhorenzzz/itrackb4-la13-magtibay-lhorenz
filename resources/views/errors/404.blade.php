@extends('layouts.app')

@section('title', 'Page not found')

@section('content')
    <style>
        .nf-wrap {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem 1rem;
        }
        .nf-code {
            font-size: clamp(5rem, 18vw, 10rem);
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #0d6efd, #6f42c1, #d63384);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: nf-float 3s ease-in-out infinite;
        }
        .nf-title {
            margin-top: 0.5rem;
            font-size: 1.75rem;
            font-weight: 700;
        }
        .nf-text {
            color: #6c757d;
            max-width: 28rem;
            margin: 0.5rem 0 1.5rem;
        }
        .nf-btn {
            display: inline-block;
            padding: 0.7rem 1.6rem;
            border-radius: 999px;
            background: linear-gradient(135deg, #0d6efd, #6f42c1);
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(13, 110, 253, 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .nf-btn:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(13, 110, 253, 0.45);
        }
        @keyframes nf-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>

    <div class="nf-wrap">
        <div class="nf-code">404</div>
        <h1 class="nf-title">Game over: page not found</h1>
        <p class="nf-text">
            Sorry, we could not find the game you were looking for.
            It may have been deleted, or the address is wrong.
        </p>
        <a class="nf-btn" href="{{ route('games.index') }}">Back to the list</a>
    </div>
@endsection

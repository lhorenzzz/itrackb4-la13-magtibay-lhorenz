{{-- Gamitin ang layout na ginagamit ng lahat ng pages mo --}}
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- <style> = CSS na para sa page na ito lang. Hindi nito ginagalaw ang ibang pages. --}}
    <style>
        /* .hero = ang malaking dark na kahon. May dalawang bahagi: kaliwa (text) at kanan (larawan) */
        .hero {
            margin-top: 3rem;
            /* radial-gradient = malabong kulay na parang ilaw sa background */
            background:
                radial-gradient(circle at 80% 80%, rgba(13, 202, 240, 0.35), transparent 45%),
                #0b0f1a;
            border-radius: 1.25rem;
            padding: 4rem 2rem;
            color: #e9ecff;
            border: 1px solid rgba(111, 66, 193, 0.5);
            box-shadow: 0 0 40px rgba(111, 66, 193, 0.3); /* glow sa paligid */

            display: flex;                    /* flex = ayusin ang laman nang magkatabi */
            flex-direction: row;              /* row = pahalang: kaliwa at kanan */
            justify-content: space-between;   /* may espasyo sa pagitan ng kaliwa at kanan */
            align-items: center;              /* sentro patayo */
            flex-wrap: wrap;                  /* kapag makitid ang screen, bababa ang larawan */
            gap: 2rem;                        /* espasyo sa pagitan ng dalawang bahagi */
            text-align: left;                 /* nakadikit sa kaliwa ang text */
        }

        /* KALIWA: lalaki ayon sa espasyo, pero hindi liliit sa baba ng 320px */
        .hero-left  { flex: 1 1 320px; }

        /* KANAN: sakto lang ang laki, nakasentro ang larawan at pangalan */
        .hero-right { flex: 0 0 auto; text-align: center; }

        /* Heading: gradient na kulay sa mismong letra */
        .hero h2 {
            font-size: clamp(2rem, 6vw, 3.5rem); /* clamp = lumiliit/lumalaki ayon sa laki ng screen */
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            background: linear-gradient(90deg, #0dcaf0, #6f42c1, #d63384);
            -webkit-background-clip: text; /* ginagawang hugis ng letra ang background */
            background-clip: text;
            color: transparent;
        }

        /* Paragraph sa ilalim ng heading */
        .hero p { color: #fff; max-width: 36rem; margin: 1rem 0 2rem; }

        /* Button: neon na may glow, lumilipad pataas kapag hinover */
        .btn-play {
            display: inline-block;
            padding: 0.8rem 2.2rem;
            border-radius: 999px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(135deg, #6f42c1, #0dcaf0);
            box-shadow: 0 0 18px rgba(13, 202, 240, 0.6);
            transition: transform 0.2s ease, box-shadow 0.2s ease; /* makinis na pagbabago */
        }
        .btn-play:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 0 30px rgba(13, 202, 240, 0.9);
        }

        /* Bilang: magkatabi pahalang. gap = espasyo sa pagitan */
        .stats      { display: flex; gap: 2rem; justify-content: flex-start; margin-top: 2rem; }
        .stat-num   { font-size: 2.2rem; font-weight: 800; color: #0dcaf0; text-shadow: 0 0 12px rgba(13, 202, 240, 0.7); }
        .stat-label { font-size: .85rem; text-transform: uppercase; letter-spacing: 1px; color: #b8c0e0; }

        /* Larawan na may neon na bilog sa paligid */
        .hero-right img {
            border: 3px solid #0dcaf0;
            box-shadow: 0 0 25px rgba(13, 202, 240, 0.7);
            object-fit: cover; /* hindi mababatak ang larawan */
        }
        .profile-name { margin-top: .75rem; font-weight: 700; color: #fff; }
        .profile-info { color: #b8c0e0; font-size: .9rem; }
    </style>

    {{-- .hero = ang dark na kahon. Lahat ng laman ng page ay nasa LOOB nito --}}
    <div class="hero">

        {{-- KALIWA: heading, paragraph, button, at bilang --}}
        <div class="hero-left">
            <h2>Find your next game to play</h2>
            <p>
                Browse a collection of games by genre, platform and release year,
                see which ones you can play with friends, and add your own favorites.
            </p>

            {{-- route('games.index') = link galing sa pangalan ng route, hindi tinype na URL --}}
            <a href="{{ route('games.index') }}" class="btn-play">Browse the games</a>

            {{-- {{ $gameCount }} at {{ $genreCount }} = numerong galing sa HomeController, kaya gumagalaw --}}
            <div class="stats">
                <div>
                    <div class="stat-num">{{ $gameCount }}</div>
                    <div class="stat-label">Games in the collection</div>
                </div>
                <div>
                    <div class="stat-num">{{ $genreCount }}</div>
                    <div class="stat-label">Genres to explore</div>
                </div>
            </div>
        </div>

        {{-- KANAN: larawan at pangalan. asset() = gumagawa ng URL papunta sa public/img/photo.png --}}
        <div class="hero-right">
            <img src="{{ asset('img/photo.png') }}" width="180" height="180"
                 class="rounded-circle" alt="My photo">
            <div class="profile-name">Lhorenz T. Magtibay</div>
            <div class="profile-info">BSIT, 4th Year, Block 4A</div>
        </div>

    </div> {{-- dito nagtatapos ang .hero. Wala nang dapat nasa ilalim nito --}}
@endsection

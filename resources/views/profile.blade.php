@extends('layouts.thirdapp')

@section('content')
<header class="masthead" id="eDart">
    <div class="container-fluid container-fluider px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="row">

            <!-- Lewa kolumna: logo i nazwa użytkownika -->
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <div class ="d-flex justify-content-center align-items-center profile-container-upper">
                    <div class="profile-container-upper-left">
                        <img src="{{ Auth::user()->profile->profile_picture }}" alt="User Logo" class="user-logo-profile fit-image">
                    </div>
                    <div class="profile-container-upper-right">
                       <span> {{ Auth::user()->username }}</span>
                    </div>
                </div>
            </div>

            <!-- Prawa kolumna: statystyki użytkownika -->
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <div class ="d-flex justify-content-center align-items-center profile-container-lower">
                    <p><strong>Miejsce w rankingu: </strong>{{ Auth::user()->profile->ranking_position}}</p>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <div class ="d-flex justify-content-center align-items-center profile-container-lower">
                    <p><strong>Punkty w rankingu: </strong> {{ Auth::user()->profile->ranking_points }}</p>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <div class ="d-flex justify-content-center align-items-center profile-container-lower">
                    <p><strong>Liczba rozegranych gier: </strong> {{ Auth::user()->profile->games_played }}</p>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <div class ="d-flex justify-content-center align-items-center profile-container-lower">
                    <p><strong>WinRatio:</strong>
                        @php
                            $gamesWon = Auth::user()->profile->games_won;
                            $playedGames = Auth::user()->profile->games_played;
                            $winRatio = $playedGames > 0 ? ($gamesWon / $playedGames) * 100 : 0;
                        @endphp
                        {{ number_format($winRatio, 2) }}%
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

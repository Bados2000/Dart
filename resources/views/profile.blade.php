@extends('layouts.thirdapp')

@section('content')
<header class="masthead" id="eDart">
    <div class="container-fluid container-fluider px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="row profile-container-profile">

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
                <div class ="d-flex justify-content-center align-items-center">
                    <p><strong>Liczba rozegranych gier:</strong> [Tutaj liczba gier]</p>
                    <p><strong>WinRatio:</strong> [Tutaj WinRatio]</p>
                    <p><strong>Punkty w rankingu:</strong> [Tutaj punkty]</p>
                    <p><strong>Miejsce w rankingu:</strong> [Tutaj miejsce]</p>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

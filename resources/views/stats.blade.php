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
                        <p>Średnia meczowa: 110 </p>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center ">
                    <div class ="d-flex justify-content-center align-items-center profile-container-lower">
                        <p>Skuteczność na podwójnych: 50 </p>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center ">
                    <div class ="d-flex justify-content-center align-items-center profile-container-lower">
                        <p>Najwyższe zejście: 140</p>
                    </div>
                </div>
                </div>
                <!-- Prawa kolumna: statystyki użytkownika -->
                <div class="col-12 d-flex justify-content-center align-items-center ">
                    <div class ="d-flex justify-content-center align-items-center profile-container-stats-score">
                        <strong>180 </strong>110
                    </div>

                    <div class ="d-flex justify-content-center align-items-center profile-container-stats-score">
                        <strong>180-141 </strong> 50
                    </div>
                    <div class ="d-flex justify-content-center align-items-center profile-container-stats-score">
                        <strong>140-121 </strong>140
                    </div>
                    <div class ="d-flex justify-content-center align-items-center profile-container-stats-score">
                        <strong>120-101 </strong>140
                    </div>
                    <div class ="d-flex justify-content-center align-items-center profile-container-stats-score">
                        <strong>100-61 </strong>140
                    </div>
                </div>

            </div>
        </div>
    </header>
@endsection

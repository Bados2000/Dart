@extends('layouts.thirdapp')

@section('content')
<header class="masthead">
    <div class="container-fluid container-fluider px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="row">

            <!-- Lewa kolumna: logo i nazwa użytkownika -->
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <div class ="d-flex justify-content-center align-items-center profile-container-upper">
                    <div class="profile-container-upper-left">
                        <img src="{{ Storage::url(Auth::user()->profile->profile_picture) }}" alt="User Logo" alt="User Logo" class="user-logo-profile fit-image">
                    </div>
                    <div class="profile-container-upper-right">
                       <span> {{ Auth::user()->username }}</span>
                    </div>
                </div>
            </div>
            <div id="profileContent">
                <!-- Prawa kolumna: statystyki użytkownika -->
                <div class="col-12 d-flex justify-content-center align-items-center" >
                    <div class ="d-flex justify-content-center align-items-center profile-container-lower">
                        <p><strong>Miejsce w rankingu: </strong>{{ Auth::user()->profile->ranking->position }}</p>
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

            <div id="statsContent" style="display: none;">
                <!-- Dolna kolumna: statystyki użytkownika -->
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
        <div id="settingsContent" style="display: none;">
            <!-- Prawa kolumna: statystyki użytkownika -->
            <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                @csrf <!-- Token CSRF -->
                <div class="col-12 d-flex justify-content-center align-items-center form-group">
                    <div class ="d-flex justify-content-center align-items-center profile-container-lower-settings flex-container">
                        <label for="profilePicture">Wybierz zdjęcie profilowe (200x200):</label>
                        <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
                    </div>
                </div>
                <!-- Dodatkowy wybór dla drugiej kamery -->
                <div class="col-12 d-flex justify-content-center align-items-center form-group">
                    <div class="d-flex justify-content-center align-items-center profile-container-lower-settings flex-container">
                        <label for="secondCameraChoice">Wybierz kamerę do podglądu ustawienia gracza :</label>
                        <select id="secondCameraChoice" name="secondCameraChoice">
                            <option value="default" {{ Auth::user()->settings->second_camera == 'default' ? 'selected' : '' }}>Domyślna kamera</option>
                            <option value="external" {{ Auth::user()->settings->second_camera == 'external' ? 'selected' : '' }}>Kamera internetowa</option>
                        </select>
                    </div>
                </div>

                <!-- Pole adresu IP dla drugiej kamery internetowej -->
                <div id="externalSecondCameraIP" style="display: none;">
                    <div class="col-12 d-flex justify-content-center align-items-center form-group">
                        <div class="d-flex justify-content-center align-items-center profile-container-lower-settings flex-container">
                            <label for="secondCameraIP">Adres IP drugiej kamery internetowej:</label>
                            <input type="text" id="secondCameraIP" name="secondCameraIP" value="{{ Auth::user()->settings->second_camera_ip ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center form-group">
                    <div class ="d-flex justify-content-center align-items-center profile-container-lower-settings flex-container">
                        <label for="autoScoring">Automatyczne zliczanie punktów:</label>
                        <input type="checkbox" id="autoScoring" name="autoScoring" {{ Auth::user()->settings->auto_scoring ? 'checked' : '' }}>
                    </div>
                </div>
                <div id="websocketServerIP" style="display: none;">
                    <div class="col-12 d-flex justify-content-center align-items-center form-group">
                        <div class="d-flex justify-content-center align-items-center profile-container-lower-settings flex-container">
                            <label for="serverIP">Adres IP serwera websocket:</label>
                            <input type="text" id="serverIP" name="serverIP" value="{{ Auth::user()->settings->websocket_server_ip ?? '' }}">
                        </div>
                    </div>
                </div>
                <div id="externalCameraChoice" style="display: none">
                    <div  class="col-12 d-flex justify-content-center align-items-center form-group">
                        <div class ="d-flex justify-content-center align-items-center profile-container-lower-settings flex-container">
                            <label for="cameraChoice">Wybierz kamerę do śledzenia  tarczy:</label>
                            <select id="cameraChoice" name="cameraChoice">
                                <option value="default" {{ Auth::user()->settings->camera == 'default' ? 'selected' : '' }}>Domyślna kamera</option>
                                <option value="external" {{ Auth::user()->settings->camera == 'external' ? 'selected' : '' }}>Kamera internetowa</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="externalCameraIP" class="dart_camera" style="display: none;">
                    <div class="col-12 d-flex justify-content-center align-items-center form-group" >
                        <div class ="d-flex justify-content-center align-items-center profile-container-lower-settings flex-container">
                            <label for="cameraIP">Adres IP kamery internetowej:</label>
                            <input type="text" id="cameraIP" name="cameraIP" value="{{ Auth::user()->settings->camera_ip ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center form-group">
                    <button type="submit">Zapisz ustawienia</button>
                </div>

            </form>
        </div>
    </div>
</header>
@endsection

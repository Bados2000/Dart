@extends('layouts.secondapp')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Masthead-->
    <header class="masthead" id="eDart">
        <div class="preview-feed-center-aftergame">
            <div class="winner-label">
                <h1> Wygrał: </h1>
            </div>
            <div class="">
                <h1 class="winner-name" id="winnerName"> </h1>
            </div>
        </div>
        <div class="in-game">
            <div class="preview-container">
                <div class="preview-feed-left">
                    <img src="https://{{ Auth::user()->settings->second_camera_ip }}:8080/video" id="cameraStream" />
                </div>
                    <div  class="preview-feed-center">
                        <div class="score_name">
                            <div class="score-name-left">
                                <span id="player1_name">{{ Auth::user()->username }} </span>
                            </div>
                            <div class="score-name-right">
                                <span id="player2_name"> {{$opponentUserName}} </span>
                            </div>
                        </div>
                        <div class="score-top">
                            <!-- Zalogowany użytkownik jest graczem 1 -->
                            @if (Auth::User()->id == $fight->player1_id)
                                <div class="score-top-left">
                                    <div class="score-top-left-left">
                                        <div class="score-top-left-left-up">
                                            <span id="user_legs">{{ $fight->player1_legs }}</span>
                                        </div>
                                        <div class="desc">
                                            <span><b>LEGS</b></span>
                                        </div>
                                    </div>
                                    <div class="score-top-left-right">
                                        <div class="score-top-left-left-down">
                                            <span id="user_score">{{ $fight->player1_points }}</span>
                                        </div>
                                        <div class="desc">
                                            <span><b>PKT</b></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="score-top-right">
                                    <div class="score-top-left-left">
                                        <div class="score-top-left-left-up">
                                            <span id="opponent_legs">{{ $fight->player2_legs }}</span>
                                        </div>
                                        <div class="desc">
                                            <span><b>LEGS</b></span>
                                        </div>
                                    </div>
                                    <div class="score-top-left-right">
                                        <div class="score-top-left-left-down">
                                            <span id="opponent_score">{{ $fight->player2_points }}</span>
                                        </div>
                                        <div class="desc">
                                            <span><b>PKT</b></span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Zalogowany użytkownik jest graczem 2 -->
                                <div class="score-top-left">
                                    <div class="score-top-left-left">
                                        <div class="score-top-left-left-up">
                                            <span id="opponent_legs">{{ $fight->player1_legs }}</span>
                                        </div>
                                        <div class="desc">
                                            <span><b>LEGS</b></span>
                                        </div>
                                    </div>
                                    <div class="score-top-left-right">
                                        <div class="score-top-left-left-down">
                                            <span id="opponent_score">{{ $fight->player1_points }}</span>
                                        </div>
                                        <div class="desc">
                                            <span><b>PKT</b></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="score-top-right">
                                    <div class="score-top-left-left">
                                        <div class="score-top-left-left-up">
                                            <span id="user_legs">{{ $fight->player2_legs }}</span>
                                        </div>
                                        <div class="desc">
                                            <span><b>LEGS</b></span>
                                        </div>
                                    </div>
                                    <div class="score-top-left-right">
                                        <div class="score-top-left-left-down">
                                            <span id="user_score">{{ $fight->player2_points }}</span>
                                        </div>
                                        <div class="desc">
                                            <span><b>PKT</b></span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="score-bot">

                        <form id="scoreForm">
                            <input type="number" id="scoreInput" placeholder="Wpisz wynik" required>
                            <button type="submit">Wyślij wynik</button>
                        </form>
                    </div>
                </div>

                <div class="preview-feed-right">
                    <img src="https://{{$opponentSecondCameraIp}}:8080/video" id="cameraStream"/>
                </div>
            </div>

            <div class="camera-container">
                <div class="camera-feed">
                    <div class="camera-containerek-left">
                        @if (Auth::user()->settings->auto_scoring)
                            <canvas id="websocket_video_canvas"></canvas>
                        @else
                            @if (Auth::user()->settings->camera == 'external')
                                <!-- Wyświetlanie obrazu z zewnętrznej kamery IP -->
                                <img src="https://{{ Auth::user()->settings->camera_ip }}:8080/video" id="cameraStream"/>
                            @else
                                <!-- Wyświetlanie obrazu z wbudowanej kamery za pomocą WebRTC -->
                                <video id="cameraStream" autoplay playsinline></video>
                            @endif
                        @endif

                    </div>
                </div>

                <div class="side-content">
                    <div class="camera-containerek-right">
                        @if ($opponentAutoScoring)
                            <canvas id="websocket_video_canvas"></canvas>
                        @else
                            @if ($opponentFirstCamera == 'external')
                                <!-- Wyświetlanie obrazu z zewnętrznej kamery IP -->
                                <img src="https://{{ $opponentCameraIp }}:8080/video" id="cameraStream"/>
                            @else
                                <!-- Wyświetlanie obrazu z wbudowanej kamery za pomocą WebRTC -->
                                <video id="cameraStream" autoplay playsinline></video>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
<script src="{{ asset('js/camera.js') }}"></script>
<script src="{{ asset('js/count.js') }}"></script>
<script src="{{ asset('js/websocket.js') }}"></script>

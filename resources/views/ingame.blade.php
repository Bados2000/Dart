@extends('layouts.secondapp')
@section('content')
    <!-- Masthead-->
    <header class="masthead" id="eDart">
        <div class="in-game">
            <div class="preview-container">
                <div class="preview-feed-left">
                    <img src="https://{{$opponentCameraIp}}:8080/video" id="cameraStream" />
                </div>

                <div class="preview-feed-center">

                </div>

                <div class="preview-feed-right">
                    <img src="https://{{ Auth::user()->settings->camera_ip }}:8080/video" id="cameraStream"/>
                </div>
            </div>

            <div class="camera-container">
                <div class="camera-feed">
                    <div class="camera-containerek-left">
                        @if (Auth::user()->settings->auto_scoring)
                            {{--to będziemy łączyć websocket--}}
                        @else
                            <!-- Wyświetlanie obrazu z zewnętrznej kamery IP -->
                            <img src="https://{{$opponentCameraIp}}:8080/video" id="cameraStream" />
                        @endif

                    </div>
                </div>

                <div class="side-content">
                    <div class="camera-containerek-right">
                        @if (Auth::user()->settings->second_camera == 'external')
                            <!-- Wyświetlanie obrazu z zewnętrznej kamery IP -->
                            <img src="https://{{ Auth::user()->settings->second_camera_ip }}:8080/video" id="cameraStream"/>
                            {{--<button id="fullscreenButtonSide" class="fullscreen-button">
                                <img src="/storage/images/fullscreen.png" alt="Pełny ekran">
                            </button>--}}
                        @else
                            <!-- Wyświetlanie obrazu z wbudowanej kamery za pomocą WebRTC -->
                            <video id="cameraStreamSide" autoplay playsinline></video>
                            {{--<button id="fullscreenButtonSide" class="fullscreen-button">
                                <img src="/storage/images/fullscreen.png" alt="Pełny ekran" />
                            </button>--}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
<script src="{{ asset('js/camera.js') }}"></script>


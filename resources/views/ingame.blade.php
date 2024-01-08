@extends('layouts.secondapp')
@section('content')
    <!-- Masthead-->
    <header class="masthead" id="eDart">
            <div class="camera-container">
                <div class="camera-feed">
                    <div class="camera-containerek">
                        @if (Auth::user()->settings->auto_scoring)
                            {{--to będziemy łączyć websocket--}}
                        @else
                            @if (Auth::user()->settings->camera == 'external')
                                <!-- Wyświetlanie obrazu z zewnętrznej kamery IP -->
                                <img src="https://{{ Auth::user()->settings->camera_ip }}:8080/video" id="cameraStream"/>
                                <button id="fullscreenButton" class="fullscreen-button">
                                    <img src="/storage/images/fullscreen.png" alt="Pełny ekran">
                                </button>
                            @else
                                <!-- Wyświetlanie obrazu z wbudowanej kamery za pomocą WebRTC -->
                                <video id="cameraStream" autoplay playsinline></video>
                                <button id="fullscreenButton" class="fullscreen-button">
                                    <img src="/storage/images/fullscreen.png" alt="Pełny ekran" />
                                </button>
                            @endif
                        @endif

                    </div>
                </div>

                <div class="side-content">
                    <div class="camera-containerek">
                        @if (Auth::user()->settings->second_camera == 'external')
                            <!-- Wyświetlanie obrazu z zewnętrznej kamery IP -->
                            <img src="https://{{ Auth::user()->settings->second_camera_ip }}:8080/video" id="cameraStream"/>
                            <button id="fullscreenButtonSide" class="fullscreen-button">
                                <img src="/storage/images/fullscreen.png" alt="Pełny ekran">
                            </button>
                        @else
                            <!-- Wyświetlanie obrazu z wbudowanej kamery za pomocą WebRTC -->
                            <video id="cameraStreamSide" autoplay playsinline></video>
                            <button id="fullscreenButtonSide" class="fullscreen-button">
                                <img src="/storage/images/fullscreen.png" alt="Pełny ekran" />
                            </button>
                        @endif
                    </div>
                </div>
            </div>
    </header>
@endsection
<script src="{{ asset('js/camera.js') }}"></script>


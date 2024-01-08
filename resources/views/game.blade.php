@extends('layouts.secondapp')
@section('content')
    <!-- Masthead-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <header class="masthead" id="eDart">
        <div class="container-fluid container-fluider px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="custom-row">
                <div class="side-div"> <!-- Lewy div -->
                    <div class="side-div-inside">
                        <img src="{{ Storage::url(Auth::user()->profile->profile_picture) }}" class="fit-image image-border">
                    </div>
                    <div class="rounded-bottom-corners">
                        <span>{{ Auth::user()->username }}</span>
                    </div>

                </div>
                <div class="center-div">
                    <img src="storage/images/vs-image-white.png" alt="VS Image" class="fit-image">
                </div>

                <div class="side-div" id="opponent-div"> <!-- Prawy div -->
                    <div class="side-div-inside">
                        <img src="/storage/images/enemy-profile.jpg" class="fit-image image-border" id="opponent-image">
                    </div>
                    <div class="rounded-bottom-corners">
                        <span id="opponent-username">Przeciwnik</span>
                    </div>
                </div>
            </div>

            <div class="text-below-row">
                <button id="joinQueueButton" class="btn btn-primary-start search-button">Graj</button>
            </div>

        </div>
    </header>
@endsection
<script src="{{ asset('js/findopp.js') }}"></script>

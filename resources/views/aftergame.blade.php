@extends('layouts.secondapp')
@section('content')
    <header class="masthead" id="eDart">
        <div class="preview-feed-center">
            <div class="winner-info">
                <div class="winner-name">{{ session('winnerName') }}</div>
                <div class="winner-label">WINNER</div>
            </div>
        </div>
    </header>
@endsection

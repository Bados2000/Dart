@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Twoja Aplikacja</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Nowości <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sponsorzy</a>
                </li>
            </ul>
            <!-- Tu dodasz elementy logowania/rejestracji i dynamiczne zmiany po zalogowaniu -->
        </div>
    </nav>

    <!-- Treść strony poniżej -->
    <div class="container" style="padding-top: 5rem;">
        <!-- Zawartość Twojej strony głównej -->
    </div>
@endsection

<!-- resources/views/partials/navbar.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Nazwa Aplikacji</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Linki nawigacyjne -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/news') }}">Nowości</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/sponsors') }}">Sponsorzy</a>
                </li>
                <!-- Linki zmieniane po zalogowaniu -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Logowanie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Rejestracja</a>
                    </li>
                @else
                    <!-- Linki dla zalogowanego użytkownika -->
                @endguest
            </ul>
        </div>
    </div>
</nav>

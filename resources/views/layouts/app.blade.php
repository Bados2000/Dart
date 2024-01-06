<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Grayscale - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

    </head>

    <body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-shrink" id="mainNav">
        <div class="container-fluid px-4 px-lg-5">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                Menu <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto">
                    <!-- Add other links as needed -->
                    <li class="nav-item"><a class="nav-link active" href="/#eDart"><b>eDart</b></a></li>
                    <li class="nav-item"><a class="nav-link" href="/#projects">Wprowadzenie</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#autosystem">Nasz projekt</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#signup">Kontakt</a></li>

                </ul>
                @auth
                    <a class="game-btn custom-a" href="{{ route('game') }}">Graj</a>
                    <a class="user-btn" href="{{ route('profile') }}" id="showProfileFromButton">
                        <img src="{{ Storage::url(Auth::user()->profile->profile_picture) }}" alt="User Logo" class="user-logo">
                        <span>{{ Auth::user()->username }}</span>
                    </a>
                @else
                    <!-- Nic nie wyświetla się dla niezalogowanych użytkowników -->
                @endauth
                <!-- Authentication Links -->
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <a class="btn btn-primary btn-primary-login" href="{{ route('login') }}">Zaloguj się</a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-primary btn-primary-sign" href="{{ route('register') }}">Utwórz konto</a>
                    @endif
                @else

                    <div class="dropdown dropdownik dropdown-toggle " id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="" >
                            <div class="menu-dotsPY">
                                <span class="dotPY">&#8226;</span>
                                <span class="dotPY">&#8226;</span>
                                <span class="dotPY">&#8226;</span>
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <!-- Twoje pozycje menu -->
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <!-- Dodaj więcej pozycji menu tutaj -->
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </div>

        @endguest

        </div>
        </div>
    </nav>


        <main class="py-4">
            @yield('test')
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>

@extends('layouts.app')

@section('test')
    <!-- Masthead-->
    <header class="masthead" id="eDart">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="form-container">
                    <form action="{{ route('register') }}" method="post">
                        @csrf <!-- Token CSRF -->
                        <div class="login-center">
                            <h2 class="sh1">REJESTRACJA</h2> <!-- Zmienione na h2 -->
                        </div>

                        <div class="form-group">
                            <label for="firstname">Imię:</label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>

                        <div class="form-group">
                            <label for="lastname">Nazwisko:</label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>

                        <div class="form-group">
                            <label for="birthdate">Data urodzenia:</label>
                            <input type="date" id="birthdate" name="birthdate" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Nazwa użytkownika:</label>
                            <input type="text" id="username" name="username" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Hasło:</label>
                            <input type="password" id="password" name="password" required>
                        </div>


                        <button type="submit" class="btn btn-primary btn-primary-login-max">Zarejestruj</button>
                        <a class="btn btn-primary btn-primary-sign-max">Mam już konto</a>

                    </form>
                </div>
            </div>
        </div>
    </header>

@endsection

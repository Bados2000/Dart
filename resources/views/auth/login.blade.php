@extends('layouts.app') <!-- Zakładając, że masz layout 'app' -->

@section('test')
    <!-- Masthead-->
    <header class="masthead" id="eDart">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="form-container">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="post">
                        @csrf <!-- Token CSRF -->
                        <div class="login-center">
                            <h7 class="sh1">LOGOWANIE</h7>
                        </div>

                        <div class="form-group">
                            <label for="username">Nazwa użytkownika:</label>
                            <input type="text" id="username" class="inputcustom" name="username" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Hasło:</label>
                            <input type="password" id="password" class="inputcustom" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-primary-login-max" style="margin-top: 10px">Zaloguj</button>
                        <a class="btn btn-primary btn-primary-sign-max" href="http://127.0.0.1:8000/register">Nie mam konta</a>

                    </form>
                </div>
            </div>
        </div>
    </header>

@endsection

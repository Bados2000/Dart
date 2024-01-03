@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="profile-container">
            <h1>Profil Użytkownika</h1>

            <!-- Informacje o użytkowniku -->
            <div class="user-info">
                <p><strong>Imię:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>

            <!-- Przyciski akcji -->
            <div class="user-actions">
                <a href="{{ route('edit.profile') }}" class="btn btn-primary">Edytuj Profil</a>
                <!-- Możesz dodać więcej przycisków akcji tutaj -->
            </div>
        </div>
    </div>
@endsection

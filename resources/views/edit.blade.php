@extends('layouts.app')

@section('title', 'Modifier Profil')

@section('content')
    <h1>Modifier le profil de {{ $user->firstname }} {{ $user->lastname }}</h1>

    <form method="POST" action="{{ route('edit', Auth::user()->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}">
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>

    <form method="POST" action="{{ route('delete', Auth::user()->id) }}" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer le compte</button>
    </form>

    <a href="{{ route('profil', Auth::user()->id) }}" class="btn btn-secondary mt-3">Retour au profil</a>
    
@endsection

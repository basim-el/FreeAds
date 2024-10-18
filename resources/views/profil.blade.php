@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <h1>Profil utilisateur de {{ $user->firstname }} {{ $user->lastname }}</h1>

    <p><strong>Nom:</strong> {{ $user->lastname }}</p>
    <p><strong>Prénom:</strong> {{ $user->firstname }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Date de création:</strong> {{ $user->created_at }}</p>
    <a href="{{ route('edit', Auth::user()->id) }}" class="btn btn-warning btn-xs">Modifier mon profil</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Déconnexion</button>
    </form>
@endsection


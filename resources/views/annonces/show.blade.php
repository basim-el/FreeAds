@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $annonce->titre }}</div>

                <div class="card-body">
                    <p>{{ $annonce->description }}</p>
                    <img src="{{ $annonce->photo }}" alt="{{ $annonce->titre }}">

                    <div class="mt-4">
                        <strong>Prix :</strong> {{ $annonce->prix }} €
                    </div>

                    @if (Auth::check() && Auth::user()->id == $annonce->user_id)
                        <div class="mt-4">
                            <form method="POST" action="{{ route('annonces.destroy', $annonce) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                            <a href="{{ route('annonces.edit', $annonce) }}" class="btn btn-warning btn-xs">Modifier</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
@endsection

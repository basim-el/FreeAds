@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Annonces</div>
                <div class="panel-body">
                    <form class="form-inline pull-right" method="GET" action="{{ route('annonces.index') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="q" placeholder="Rechercher...">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </form>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Créé le</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($annonces as $annonce)
                                <tr>
                                    <td>{{ $annonce->id }}</td>
                                    <td><img src="{{ asset($annonce->photo) }}" alt="{{ $annonce->title }}" style="max-height: 100px;"></td>
                                    <td>{{ $annonce->titre }}</td>
                                    <td>{{ $annonce->description }}</td>
                                    <td>{{ $annonce->prix }} €</td>
                                    <td>{{ $annonce->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($annonce->user_id == Auth::id())
                                            <a href="{{ route('annonces.show', $annonce->id) }}" class="btn btn-primary btn-xs">Voir</a>
                                            <a href="{{ route('annonces.edit', $annonce->id) }}" class="btn btn-warning btn-xs">Editer</a>
                                            <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" style="display: inline-block;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-xs">Supprimer</button>
                                            </form>
                                        @else
                                            <a href="{{ route('annonces.show', $annonce->id) }}" class="btn btn-primary btn-xs">Voir</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $annonces->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection





@extends('layouts.app')

@section('title', 'Liste des Voitures')

@section('content')
    <h1>Liste des Voitures</h1>

    <a href="{{ route('voitures.create') }}" class="btn btn-primary mb-3">Créer une nouvelle voiture</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Réservoir</th>
                <th>Quantité de Carburant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($voitures as $voiture)
            <tr>
                <td>{{ $voiture->marque }}</td>
                <td>{{ $voiture->modele }}</td>
                <td>{{ $voiture->reservoir }} L</td>
                <td>{{ $voiture->qte_carburant }} L</td>
                <td>
                    <a href="{{ route('voitures.show', $voiture->id) }}" class="btn btn-info">Afficher</a>
                    <a href="{{ route('voitures.edit', $voiture->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('voitures.destroy', $voiture->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

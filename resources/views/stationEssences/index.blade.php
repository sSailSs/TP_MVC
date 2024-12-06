@extends('layouts.app')

@section('title', 'Liste des Stations Essence')

@section('content')
    <h1>Liste des Stations Essence</h1>

    <a href="{{ route('stationEssences.create') }}" class="btn btn-primary mb-3">Créer une nouvelle station</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Localisation</th>
                <th>Capacité Totale</th>
                <th>Quantité Actuelle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stationEssences as $station)
                <tr>
                    <td>{{ $station->nom }}</td>
                    <td>{{ $station->localisation }}</td>
                    <td>{{ $station->total_citernes }} L</td>
                    <td>{{ $station->qte_carburant }} L</td>
                    <td>
                        <a href="{{ route('stationEssences.show', $station->id) }}" class="btn btn-info">Afficher</a>
                        <a href="{{ route('stationEssences.edit', $station->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('stationEssences.destroy', $station->id) }}" method="POST" style="display:inline;">
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

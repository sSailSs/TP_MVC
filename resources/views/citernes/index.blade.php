@extends('layouts.app')

@section('title', 'Liste des Citernes')

@section('content')
    <h1>Liste des Citernes</h1>

    <a href="{{ route('citernes.create') }}" class="btn btn-primary mb-3">Ajouter une Citerne</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Station</th>
                <th>Type de Carburant</th>
                <th>Capacité</th>
                <th>Quantité Actuelle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citernes as $citerne)
                <tr>
                    <td>{{ $citerne->stationEssence->nom }}</td>
                    <td>{{ $citerne->carburant->type }}</td>
                    <td>{{ $citerne->capacite }} L</td>
                    <td>{{ $citerne->qte_carburant }} L</td>
                    <td>
                        <a href="{{ route('citernes.edit', $citerne->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('citernes.destroy', $citerne->id) }}" method="POST" style="display:inline;">
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

@extends('layouts.app')

@section('title', 'Liste des Carburants')

@section('content')
    <h1>Liste des Carburants</h1>

    <a href="{{ route('carburants.create') }}" class="btn btn-primary mb-3">Ajouter un Carburant</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carburants as $carburant)
                <tr>
                    <td>{{ $carburant->type }}</td>
                    <td>
                        <a href="{{ route('carburants.edit', $carburant->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('carburants.destroy', $carburant->id) }}" method="POST" style="display:inline;">
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

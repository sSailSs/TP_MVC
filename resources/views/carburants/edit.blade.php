<!DOCTYPE html>
<html>
<head>
    <title>Modifier un Carburant</title>
</head>
<body>
    <h1>Modifier un Carburant</h1>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('carburants.update', $carburant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="type">Type de Carburant :</label>
            <select id="type" name="type" required>
                <option value="SP95" {{ $carburant->type == 'SP95' ? 'selected' : '' }}>SP95</option>
                <option value="SP95-E10" {{ $carburant->type == 'SP95-E10' ? 'selected' : '' }}>SP95-E10</option>
                <option value="SP98" {{ $carburant->type == 'SP98' ? 'selected' : '' }}>SP98</option>
                <option value="Gazole" {{ $carburant->type == 'Gazole' ? 'selected' : '' }}>Gazole</option>
            </select>
        </div>
        <div>
            <button type="submit">Mettre à jour</button>
        </div>
    </form>

    <a href="{{ route('carburants.index') }}">Retour à la liste</a>
</body>
</html>

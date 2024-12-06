<!DOCTYPE html>
<html>
<head>
    <title>Créer un Carburant</title>
</head>
<body>
    <h1>Créer un Carburant</h1>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('carburants.store') }}" method="POST">
        @csrf
        <div>
            <label for="type">Type de Carburant :</label>
            <select id="type" name="type" required>
                <option value="SP95">SP95</option>
                <option value="SP95-E10">SP95-E10</option>
                <option value="SP98">SP98</option>
                <option value="Gazole">Gazole</option>
            </select>
        </div>
        <div>
            <button type="submit">Créer</button>
        </div>
    </form>

    <a href="{{ route('carburants.index') }}">Retour à la liste</a>
</body>
</html>

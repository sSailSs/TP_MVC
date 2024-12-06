<!DOCTYPE html>
<html>
<head>
    <title>Créer une Voiture</title>
</head>
<body>
    <h1>Créer une Voiture</h1>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('voitures.store') }}" method="POST">
        @csrf
        <div>
            <label for="marque">Marque :</label>
            <input type="text" id="marque" name="marque" value="{{ old('marque') }}" required>
        </div>
        <div>
            <label for="modele">Modèle :</label>
            <textarea id="modele" name="modele" required>{{ old('modele') }}</textarea>
        </div>
        <div>
            <label for="reservoir">Réservoir (litres) :</label>
            <input type="number" id="reservoir" name="reservoir" step="0.01" min="20" max="200" value="{{ old('reservoir') }}" required>
        </div>
        <div>
            <label for="qte_carburant">Quantité de Carburant :</label>
            <input type="number" id="qte_carburant" name="qte_carburant" step="0.01" min="0" max="200" value="{{ old('qte_carburant') }}" required>
        </div>
        <div>
            <button type="submit">Créer</button>
        </div>
    </form>

    <a href="{{ route('voitures.index') }}">Retour à la liste</a>
</body>
</html>

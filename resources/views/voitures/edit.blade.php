<!DOCTYPE html>
<html>
<head>
    <title>Modifier une Voiture</title>
</head>
<body>
    <h1>Modifier une Voiture</h1>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('voitures.update', $voiture->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="marque">Marque :</label>
            <input type="text" id="marque" name="marque" value="{{ $voiture->marque }}" required>
        </div>
        <div>
            <label for="modele">Modèle :</label>
            <input type="text" id="modele" name="modele" value="{{ $voiture->modele }}" required>
        </div>
        <div>
            <label for="reservoir">Réservoir (litres) :</label>
            <input type="number" id="reservoir" name="reservoir" step="0.01" min="20" max="200" value="{{ $voiture->reservoir }}" required>
        </div>
        <div>
            <label for="qte_carburant">Quantité de Carburant Actuelle (litres) :</label>
            <input type="number" id="qte_carburant" name="qte_carburant" step="0.01" min="0" max="{{ $voiture->reservoir }}" value="{{ $voiture->qte_carburant }}" required>
        </div>
        <div>
            <button type="submit">Mettre à jour</button>
        </div>
    </form>

    <a href="{{ route('voitures.index') }}">Retour à la liste</a>
</body>
</html>

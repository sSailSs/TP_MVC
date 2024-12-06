<!DOCTYPE html>
<html>
<head>
    <title>Créer une Station Essence</title>
</head>
<body>
    <h1>Créer une Station Essence</h1>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('stationEssences.store') }}" method="POST">
        @csrf
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>
        <div>
            <label for="localisation">Localisation :</label>
            <input type="text" id="localisation" name="localisation" value="{{ old('localisation') }}" required>
        </div>
        <div>
            <label for="total_citernes">Capacité Totale des Citernes (litres) :</label>
            <input type="number" id="total_citernes" name="total_citernes" step="0.01" min="5000" max="20000" value="{{ old('total_citernes') }}" required>
        </div>
        <div>
            <label for="qte_carburant">Quantité de Carburant Actuelle (litres) :</label>
            <input type="number" id="qte_carburant" name="qte_carburant" step="0.01" min="0" max="{{ old('total_citernes') }}" value="{{ old('qte_carburant') }}" required>
        </div>
        <div>
            <button type="submit">Créer</button>
        </div>
    </form>

    <a href="{{ route('stationEssences.index') }}">Retour à la liste</a>
</body>
</html>

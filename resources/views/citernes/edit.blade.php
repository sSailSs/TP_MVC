<!DOCTYPE html>
<html>
<head>
    <title>Modifier une Citerne</title>
</head>
<body>
    <h1>Modifier une Citerne</h1>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('citernes.update', $citerne->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="station_essence_id">Station Essence :</label>
            <select id="station_essence_id" name="station_essence_id" required>
                @foreach ($stations as $station)
                    <option value="{{ $station->id }}" {{ $station->id == $citerne->station_essence_id ? 'selected' : '' }}>
                        {{ $station->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="carburant_id">Type de Carburant :</label>
            <select id="carburant_id" name="carburant_id" required>
                @foreach ($carburants as $carburant)
                    <option value="{{ $carburant->id }}" {{ $carburant->id == $citerne->carburant_id ? 'selected' : '' }}>
                        {{ $carburant->type }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="capacite">Capacité (litres) :</label>
            <input type="number" id="capacite" name="capacite" step="0.01" min="1000" max="5000" value="{{ $citerne->capacite }}" required>
        </div>
        <div>
            <label for="qte_carburant">Quantité Actuelle (litres) :</label>
            <input type="number" id="qte_carburant" name="qte_carburant" step="0.01" min="0" max="{{ $citerne->capacite }}" value="{{ $citerne->qte_carburant }}" required>
        </div>
        <div>
            <button type="submit">Mettre à jour</button>
        </div>
    </form>

    <a href="{{ route('citernes.index') }}">Retour à la liste</a>
</body>
</html>

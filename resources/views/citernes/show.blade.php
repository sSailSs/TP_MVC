<!DOCTYPE html>
<html>
<head>
    <title>Détails de la Citerne</title>
</head>
<body>
    <h1>Détails de la Citerne</h1>

    <p><strong>Station Essence :</strong> {{ $citerne->stationEssence->nom }}</p>
    <p><strong>Type de Carburant :</strong> {{ $citerne->carburant->type }}</p>
    <p><strong>Capacité :</strong> {{ $citerne->capacite }} litres</p>
    <p>
        <strong>Quantité Actuelle :</strong> {{ $citerne->qte_carburant }} litres
        ({{ round(($citerne->qte_carburant / $citerne->capacite) * 100, 2) }}%)
    </p>

    <a href="{{ route('citernes.index') }}">Retour à la Liste des Citernes</a>
</body>
</html>

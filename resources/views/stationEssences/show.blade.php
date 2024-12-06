<!DOCTYPE html>
<html>
<head>
    <title>Détails de la Station Essence</title>
</head>
<body>
    <h1>Détails de la Station Essence</h1>

    <p><strong>Nom :</strong> {{ $stationEssence->nom }}</p>
    <p><strong>Localisation :</strong> {{ $stationEssence->localisation }}</p>
    <p><strong>Capacité Totale des Citernes :</strong> {{ $stationEssence->total_citernes }} litres</p>
    <p>
        <strong>Quantité Actuelle :</strong> {{ $stationEssence->qte_carburant }} litres
        ({{ round(($stationEssence->qte_carburant / $stationEssence->total_citernes) * 100, 2) }}%)
    </p>

    <a href="{{ route('stationEssences.index') }}">Retour à la Liste des Stations</a>
</body>
</html>

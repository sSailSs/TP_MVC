<!DOCTYPE html>
<html>
<head>
    <title>Détails de la Voiture</title>
</head>
<body>
    <h1>Détails de la Voiture</h1>

    <p><strong>Marque :</strong> {{ $voiture->marque }}</p>
    <p><strong>Modèle :</strong> {{ $voiture->modele }}</p>
    <p><strong>Capacité du Réservoir :</strong> {{ $voiture->reservoir }} litres</p>
    <p>
        <strong>Pourcentage de Remplissage :</strong>
        @if ($voiture->reservoir > 0)
            {{ round(($voiture->qte_carburant / $voiture->reservoir) * 100, 2) }}%
        @else
            0%
        @endif
    </p>

    <a href="{{ route('voitures.index') }}">Retour à la Liste des Voitures</a>
</body>
</html>

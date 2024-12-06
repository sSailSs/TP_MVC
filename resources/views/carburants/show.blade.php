<!DOCTYPE html>
<html>
<head>
    <title>Détails du Carburant</title>
</head>
<body>
    <h1>Détails du Carburant</h1>

    <p><strong>Type :</strong> {{ $carburant->type }}</p>

    <a href="{{ route('carburants.index') }}">Retour à la Liste des Carburants</a>
</body>
</html>

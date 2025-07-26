<!DOCTYPE html>
<html>
<head>
    <title>Nouveau message</title>
</head>
<body>
    <h1>Demande de remboursement</h1>
    Cette utilisateur nous a envoy&eacute; un document portant le titre {{ $emailData['titre'] }}.
    
    <p><strong>Nom :</strong> {{ $emailData['nom'] }}</p>
    <p><strong>Email :</strong> {{ $emailData['email'] }}</p>
    <p><strong>Téléphone :</strong> {{ $emailData['phone'] }}</p>
	<img src="https://api.app.assurances-f2l.fr/public/storage/filaka/{{ $emailData['path'] }}" style="width:300px; height: auto">
</body>
</html>

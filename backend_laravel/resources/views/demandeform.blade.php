<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle demande</title>
</head>
<body>
    <h1>Demande d'inscription à une association</h1>

    <p>Vous avez reçu une nouvelle demande :</p>
    <ul>
        <li><strong>Nom :</strong> {{ $data['last_name'] }}</li>
        <li><strong>Prénom :</strong> {{ $data['first_name'] }}</li>
        <li><strong>Email :</strong> {{ $data['email'] }}</li>
    </ul>
    <p>Merci!</p>
</body>
</html>

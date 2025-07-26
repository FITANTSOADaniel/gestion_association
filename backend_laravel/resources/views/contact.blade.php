<!DOCTYPE html>
<html>
<head>
    <title>Nouveau message</title>
</head>
<body>
    <h1>Message</h1>
    Cette utilisateur nous a contact$eacute; via le formulaire de contact.
    
    <p><strong>Nom :</strong> {{ $emailData['nom'] }}</p>
    <p><strong>Email :</strong> {{ $emailData['email'] }}</p>
    <p><strong>Téléphone :</strong> {{ $emailData['phone'] }}</p>
    <p><strong>Message :</strong> {{ $emailData['message'] }}</p>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Bonjour {{$user->name}}</h1>
    <p>Votre compte fournisseur est accéssible via les coordonnées suivantes</p>
    <p>
        Login : {{$user->email}} <br>
        Mot de passe : {{$password}}
    </p>
</body>
</html>
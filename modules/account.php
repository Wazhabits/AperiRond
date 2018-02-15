<?php
session_start();

?>

<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
</head>
<body>

<h1 style="text-align: center">Créer votre compte</h1>

<form action="libraries/createAccount.php" method="post">

    <h2>Coordonnées</h2>

    <label for="email">Email : </label>
    <input type="email" id="email" name="email" placeholder="Ex : abdoulaye.toure@gmail.com" required>

    <label for="tel">Téléphone : </label>
    <input type="tel" id="tel" name="phone" placeholder="Ex : +33656789856">

    <h2>Mot de passe</h2>

    <label for="mdp">Mot de passe : </label>
    <input type="password" id="mdp" name="password" placeholder="Entrer votre mot de passe" required>

    <label for="confmdp">Confirmer mot de passe : </label>
    <input type="password" id="confmdp" name="password" placeholder="Confirmer mot de passe" required>

    <h2>Lieu de résidence</h2>

    <p><label for="numrue">N° voie : </label>
        <input type="number" id="numrue" name="streetNumber" placeholder="Ex : 1"></p>

    <p><label for="rue">Rue : </label>
        <input type="text" id="rue" name="street" placeholder="Ex : boulevard Nicodev"></p>

    <p><label for="complementAdresse">Complément d'adresse : </label>
        <input type="text" id="complementAdresse" name="compStreet"></p>

    <p><label for="cp">Code postal : </label>
        <input type="number" id="cp" name="posteCode" placeholder="Ex : 44470"></p>

    <p><label for="ville">Ville : </label>
        <input type="text" id="ville" name="city" placeholder="Ex : Nantes"></p>

    <p><label for="pays">Pays : </label>
        <input type="text" id="pays" name="country" value="FRANCE" required></p>

    <button type="submit">Créer un compte</button>

</form>
</body>
</html>
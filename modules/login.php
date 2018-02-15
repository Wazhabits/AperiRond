<?php
session_start();

if(isset($_SESSION["error_message"])){
    $error = $_SESSION["error_message"];

    unset($_SESSION["error_message"]);
}

?>

<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Se connecter</title>
</head>
<body>

<?php if(isset($error)) { ?>
    <h1><?php echo $error?></h1>
<?php } ?>

    <form action="libraries/treatment.php" method="post">

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Entrer votre email">

        <label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="password" placeholder="Entrer votre mot de passe">

        <button type="submit">Se connecter</button>

    </form>
</body>
</html>
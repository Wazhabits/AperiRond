<?php
    if(isset($_SESSION["error_message"])){
        $error = $_SESSION["error_message"];
        unset($_SESSION["error_message"]);
    }
    if(isset($error))
        echo $error;
?>
<form action="treatment.php" method="post">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Entrer votre email">
    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="password" placeholder="Entrer votre mot de passe">
    <button type="submit">Se connecter</button>
</form>
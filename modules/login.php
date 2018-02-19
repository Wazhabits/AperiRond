<?php
if(isset($_SESSION["error_message"])){
    $error = $_SESSION["error_message"];
    unset($_SESSION["error_message"]);
}
?>

<?php if(isset($error)) { ?>
    <h1><?php echo $error?></h1>
<?php } ?>
<!-- Page de connexion -->
<div id="login_container" class="container">
    <div id="login_row" class="row">
    <form class="col-xs-2 col-sm-4 col-md-12 col-lg-12 col-xl-12" action="" method="post">
        <label class="label_connexion" for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Entrer votre email">
        <label class="label_connexion" for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="password" placeholder="Entrer votre mot de passe">
        <button id="button_connexion" name="connection" type="submit">Se connecter</button>
    </form>
    </div>
</div>
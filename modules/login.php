<?php
if(isset($_SESSION["error_message"])){
    $error = $_SESSION["error_message"];
    unset($_SESSION["error_message"]);
}
?>

<?php if(isset($error)) { ?>
    <h1><?php echo $error?></h1>
<?php } ?>
<div id="login_container" class="container">
    <div id="login_row" class="row">
    <form class="col-xs-2 col-sm-4 col-md-12 col-lg-12 col-xl-12" action="" method="post">
        <label class="label_connexion" for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Entrer votre email">
        <label class="label_connexion" for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="password" placeholder="Entrer votre mot de passe">
        <button id="button_connexion" name="submit" type="submit">Se connecter</button>
    </form>
    </div>
</div>

<?php
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$pass."'";
        $result = $database->query($sql);
        $result = $result->fetchAll();
        if (count($result) == 0)
            echo "Erreur de connexion";
        else {
            $_SESSION['login'] = array(5);
            $_SESSION['login'][0] = $result[0]['id'];
            $_SESSION['login'][1] = $result[0]['email'];
            $_SESSION['login'][2] = $result[0]['nom']." ".$result[0]['prenom'];
            $_SESSION['login'][3] = $result[0]['numrue']." ".$result[0]['rue']." ".$result[0]['ville']. ", ".$result[0]['cp'];
            $_SESSION['login'][4] = $result[0]['telephone'];
            header("Location: index.php");
        }
    }
?>
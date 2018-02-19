<?php
    session_start();
    include "function/function.php";
    include "db_settings.php";
    $database = new PDO('mysql:host='.$host.';dbname='.$dbname, $user_db, $pwd_db);
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
        <script href="assets/js/bootstrap.min.js"></script>
        <title>Aperi Rond - VIVE LES APEROS GEOMETRIQUE !</title>
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./assets/css/aperirond.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if (isset($_POST['connection'])) {
            // On récupere les champs
            $email = $_POST['email'];
            $pass = md5($_POST['password']);
            // On prépare la requête sql
            $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$pass."'";
            $result = $database->query($sql);
            $result = $result->fetchAll();
            // Si la requête ne donne aucun résultat
            if (count($result) == 0)
                echo "Erreur de connexion";
            else {
                // On créer la session
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
        <h1><?php if (!isset($_GET['cmd_usr'])) { echo "Aperi Rond"; } else { echo "Commande"; } ?></h1>
        <?php if(isset($_SESSION["login"])){

            $id = $_SESSION["login"][0];
            $prenom = $database->query("select prenom from users WHERE id = $id ");

            $prenom = $prenom->fetchAll();

            ?> <p style="text-align: center;">Bienvenue <?php echo $prenom[0]["prenom"]; ?>
                <a href="modules/logout.php" title="Déconnexion">Se déconnecter <i style="font-size: 14px;" class="fas fa-sign-out-alt"></i></a></p>
            <?php
            if (isset($_GET['cmd'])) {
                ?>
                    <p class="success">Commande passée !</p>
                <?php
            }
        }
        if (empty($_GET['article']) || isset($_GET['add_to_cart']) || isset($_GET['del_cart']) || isset($_GET['cmd_usr'])) {
            if (isset($_GET['del_cart'])) {
               include "modules/del_cart.php";
            } else {
                if (isset($_GET['add_to_cart']))
                    include "modules/add_to_cart.php";
                else
                    if (isset($_GET['cmd_usr']))
                        include "modules/tunnel.php";
                    else
                        include "modules/list.php";
            }
        } else
            include "modules/article.php";
        if (isset($_SESSION['login'])) {
            if (!isset($_GET['cmd_usr']))
               include "modules/cart.php";
        }
        else
            include "modules/member.php";
        ?>
    </body>
</html>
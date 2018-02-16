<?php
    session_start();
    include "function/function.php";
    $database = new PDO('mysql:host=localhost;dbname=aperirond', 'root', '');
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
        <h1>Aperi Rond</h1>
        <?php if (empty($_GET['article']) || isset($_GET['add_to_cart']) || isset($_GET['del_cart'])) {
            if (isset($_GET['del_cart'])) {
               include "modules/del_cart.php";
            } else {
                if (isset($_GET['add_to_cart']))
                    include "modules/add_to_cart.php";
                else
                    include "modules/list.php";
            }
        } else
            include "modules/article.php";
        if (isset($_SESSION['login'])) {
            include "modules/cart.php";
        }
        else {
            include "modules/member.php";
        }
        ?>
    </body>
</html>
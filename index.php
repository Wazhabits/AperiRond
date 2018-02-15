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
    <title>Index</title>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="./assets/css/aperirond.css" rel="stylesheet">
</head>
<body>
    <?php if (empty($_GET['article']) || isset($_GET['add_to_cart'])) {
        if (isset($_GET['add_to_cart'])) {
            $fields = array(3);
            $values = array(3);
            $fields[0] = "user";
            $fields[1] =  "article";
            $fields[2] = "quantity";
            $values[0] = 1;
            $values[1] = $_GET['add_to_cart'];
            $values[2] = $_POST['quantity'];
            InsertValues($database, "cart", $fields, $values);
            Header("Location: index.php");
        }
        else
            include "modules/list.php";
    } else
        include "modules/article.php";
    ?>
</body>
</html>
<?php
    include "function/function.php";
    $database = new PDO('mysql:host=localhost;dbname=projet', 'root', '');
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
    <link href="./assets/css/" rel="stylesheet">
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
    } else {
        $article = GetTableSpe($database, "articles", "id", $_GET['article']);
        $stock = GetTableSpe($database, "stocks", "id", $_GET['article']);
        $avis = GetTableSpe($database, "avis", "refer", $_GET['article']);
        $i = 0;
        ?>
        <div id="article_container" class="container">
            <div id="article_row" class="row">
                <div class="col-xs-2 col-sm-2-down hidden-md-down hidden-lg-down hidden-xl"></div>
                <div id="article_img" class="col-xs-8 col-sm-8 col-md-6 col-lg-6 col-xl-6">
                    <?php echo "IMG";//$articles[$i]['img']; ?>
                </div>
                <div class="col-xs-2 col-sm-2-down hidden-md-down hidden-lg-down hidden-xl"></div>
                <div id="article_title" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <?php echo $article[0]['nom']; ?>
                </div>
                <div id="article_description" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <?php echo $article[0]['description']; ?>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
</html>
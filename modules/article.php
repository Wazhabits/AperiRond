<?php
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
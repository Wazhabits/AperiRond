<div id="list_article_container" class="container">
    <div id="list_article_row" class="row">
        <!-- LISTE D'ARTICLE -->
        <?php
        $i = 0;
        $articles = GetTable($database, "articles");
        if (count($articles) == 0) {
            ?>
            <span id="no_article"><i class="fas fa-ban"></i> Aucun article à afficher</span>
            <?php
        }
        else
            while ($i < count($articles)) {
                $stock = GetTableSpe($database, "stocks", "id", $articles[$i]['id']);
                ?>

                <div id="article_box" class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                    <header><span id="article_title"><?php echo $articles[$i]['nom']; ?></span><span id="article_disponible"><?php if($stock[0]['quantite'] != 0){ ?><i class="fas fa-battery-full valid"></i><?php } else { ?><i class="fas fa-battery-empty unvalid"></i><?php } ?></span></header>
                    <main><?php echo $articles[$i]['description']; ?></main>
                    <footer>
                        <?php if($stock[0]['quantite'] != 0){ ?>
                            <form action="?add_to_cart=<?php echo $articles[$i]['id']; ?>" method="post">
                                <select name="quantity" id="add_to_cart_select">
                                    <?php
                                        $j = 0;
                                        while ($j < $stock[0]['quantite'])
                                            echo "<option value='".++$j."'>".$j."</option>";
                                    ?>
                                </select>
                                <button name="submit" <?php if (!isset($_SESSION['login'])) { echo "disabled"; } ?>><i class="fas fa-cart-arrow-down"></i></button>
                            </form>
                            <?php echo "<strong>".$articles[$i]['prix']."€</strong>"; ?>
                        <?php } else { echo "Rupture"; } ?>
                        <a href="?article=<?php echo $articles[$i]['id']; ?>">En savoir plus <i class="fas fa-angle-double-right"></i></a>
                    </footer>
                </div>

                <?php
                $i++;
            }
        ?>
    </div>
    <hr>
</div>
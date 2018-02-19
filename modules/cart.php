<!-- PANIER -->
<div class="container">
    <div id='cart' class="row col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h2><i class="fas fa-shopping-cart"></i></h2>
        <?php
            $cart = GetTableSpe($database, "cart", 'user', $_SESSION['login'][0]);
            $i = 0;
            $total = 0;
            while ($i < count($cart)) {
                $article = GetTableSpe($database, 'articles', 'id', $cart[$i]['article']);
                echo "<p class='col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12'><a href='?del_cart=".$cart[$i]['id']."'><i class=\"fas fa-times\"></i></a><i class=\"far fa-check-circle\"></i> <strong>" . $article[0]['nom'] . "</strong> (".$article[0]['prix']."€) x <strong>" . $cart[$i]['quantity'] . "</strong><span id='prix' class='right'>".($article[0]['prix'] * $cart[$i]['quantity'])."€</span></p>";
                $total += ($article[0]['prix'] * $cart[$i]['quantity']);
                $i++;
            }
            if ($i != 0)
                echo "<hr class='col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12'><span class='row col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 center'><a href='?cmd_usr=".$_SESSION['login'][0]."'><i class=\"fas fa-arrow-right\"></i> Terminer ma commande</a></span><span id='prix_tot' class='right col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xl-3'>Prix total :</span><span id='prix_tot' class='right col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xl-3'><strong>".$total."€</strong></span>";
            else
                echo "Aucun article dans le panier";
            ?>
    </div>
</div>
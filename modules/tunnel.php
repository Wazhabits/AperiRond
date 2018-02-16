<div class="container">
    <!-- Tunnel de commande -->
    <div class="row">
        <?php
        // Première partie du tunnel (Recapitulatif du panier
        if (!isset($_GET['part'])) {?>
                <div id='cart' class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h2><i class="fas fa-shopping-cart"></i></h2>
                    <?php
                        $cart = GetTableSpe($database, "cart", 'user', $_SESSION['login'][0]);
                        $i = 0;
                        $total = 0;
                        while ($i < count($cart)) {
                            $article = GetTableSpe($database, 'articles', 'id', $cart[$i]['article']);
                            echo "<p class='cmd_list col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12'><a href='?del_cart=".$cart[$i]['id']."&cmd_usr=".$_GET['cmd_usr']."'><i class=\"fas fa-times\"></i></a><i class=\"far fa-check-circle\"></i> <strong>" . $article[0]['nom'] . "</strong> (".$article[0]['prix']."€) x <strong>" . $cart[$i]['quantity'] . "</strong><span id='prix' class='right'>".($article[0]['prix'] * $cart[$i]['quantity'])."€</span></p>";
                            $total += ($article[0]['prix'] * $cart[$i]['quantity']);
                            $i++;
                        }
                        if ($i != 0)
                            echo "<hr class='col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12'><span id='prix_tot' class='right col-sm-9 col-xs-9 col-md-9 col-lg-9 col-xl-9'>Prix total :</span><span id='prix_tot' class='right col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xl-3'><strong>".$total."€</strong></span>";
                        else
                            echo "Aucun article dans le panier";
                        ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <a href="?cmd_usr=<?php echo $_GET['cmd_usr']; ?>&part=1" class="continue"><i class="fas fa-arrow-circle-right"></i> Continuer</a>
                </div>
        <?php } else {
                // Deuxième partie du tunnel (Informations de livraisons
                if ($_GET['part'] == 1) {
                    if (count($user = GetTableSpe($database, "commandes", "user", $_SESSION['login'][0])) == 0) {
                        $user = GetTableSpe($database, "users", "id", $_SESSION['login'][0])
                        ?>
                        <form id="cmd_inf" action="" method="post" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label for="nom">Nom :</label><input name="nom" type="text" value="<?php echo $user[0]['nom']; ?>">
                            <label for="prenom">Prénom :</label><input name="prenom" type="text" value="<?php echo $user[0]['prenom']; ?>">
                            <label for="numr">Numéro de rue :</label><input name="numr" type="text" value="<?php echo $user[0]['numrue']; ?>">
                            <label for="rue">Nom de rue :</label><input name="rue" type="text" value="<?php echo $user[0]['rue']; ?>">
                            <label for="cp">Code Postale :</label><input name="cp" type="text" value="<?php echo $user[0]['cp']; ?>">
                            <label for="ville">Ville :</label><input name="ville" type="text" value="<?php echo $user[0]['ville']; ?>">
                            <div class="continue col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <button class="continue" name="submit"><i class="fas fa-arrow-circle-right"></i> Continuer</button>
                            <a href="?cmd_usr=<?php echo $_GET['cmd_usr']; ?>" class="previous"><i class="fas fa-arrow-circle-left"></i> Précédent</a>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            // On crée une nouvelle commande
                            extract($_POST);
                            $database->exec("INSERT INTO `commandes` (`user`, `ref`, `nom`, `prenom`, `num_adresse`, `nom_adresse`, `ville`, `cp`, `valid`, `paid`) VALUES ('".$_SESSION['login'][0]."', '".$_SESSION['login'][0]."', '$nom', '$prenom', '$numr', '$rue', '$cp', '$ville', '0', '0')");
                            header("Location: index.php?cmd_usr=".$_GET['cmd_usr']."&part=2");
                        }
                    } else {
                        // Si une ancienne commande existe déja
                        echo "<span class='centered'>Ces informations ont été remplit avec celles de votre dernière commande</span>"; ?>
                        <form id="cmd_inf" action="" method="post" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label for="nom">Nom :</label><input name="nom" type="text" value="<?php echo $user[0]['nom']; ?>">
                            <label for="prenom">Prénom :</label><input name="prenom" type="text" value="<?php echo $user[0]['prenom']; ?>">
                            <label for="numr">Numéro de rue :</label><input name="numr" type="text" value="<?php echo $user[0]['num_adresse']; ?>">
                            <label for="rue">Nom de rue :</label><input name="rue" type="text" value="<?php echo $user[0]['nom_adresse']; ?>">
                            <label for="cp">Code Postale :</label><input name="cp" type="text" value="<?php echo $user[0]['cp']; ?>">
                            <label for="ville">Ville :</label><input name="ville" type="text" value="<?php echo $user[0]['ville']; ?>">
                            <div class="continue col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <button class="continue" name="submit"><i class="fas fa-arrow-circle-right"></i> Continuer</button>
                                <a href="?cmd_usr=<?php echo $_GET['cmd_usr']; ?>" class="previous"><i class="fas fa-arrow-circle-left"></i> Précédent</a>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            // On met a jour la commande
                            extract($_POST);
                            $fields = array(10);
                            $val = [10];
                            $fields[0] = "user";
                            $fields[1] = "ref";
                            $fields[2] = "nom";
                            $fields[3] = "prenom";
                            $fields[4] = "num_adresse";
                            $fields[5] = "nom_adresse";
                            $fields[6] = "ville";
                            $fields[7] = "cp";
                            $fields[8] = "valid";
                            $fields[9] = "paid";
                            $val[0] = $_SESSION['login'][0];
                            $val[1] = $_SESSION['login'][0];
                            $val[2] = $prenom;
                            $val[3] = $nom;
                            $val[4] = $numr;
                            $val[5] = $rue;
                            $val[6] = $cp;
                            $val[7] = $ville;
                            $val[8] = 0;
                            $val[9] = 0;
                            UpdateValues($database, "commandes", $fields, $val, 'id', $user[0]['id']);
                            header("Location: index.php?cmd_usr=".$_GET['cmd_usr']."&part=2");
                        }
                    }
                }
                else {
                    if ($_GET['part'] == 2) {
                        // Récapitulatif de la comande + de l'adresse / nom de livraison
                        $cmd = GetTableSpe($database, "commandes", "user", $_SESSION['login'][0]);
                    ?>
                        <h2>Recapitulatif</h2>
                        <div id='info' class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg62 col-xl-6">
                                <p>Reférence</p>
                                <p>Nom</p>
                                <p>Adresse</p>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg62 col-xl-6">
                                <p>#<?php echo $cmd[0]['ref']; ?></p>
                                <p>Mr/Mme <?php echo $cmd[0]['nom']; ?> <?php echo $cmd[0]['prenom']; ?></p>
                                <p><?php echo $cmd[0]['num_adresse']; ?> <?php echo $cmd[0]['nom_adresse']; ?>, <?php echo $cmd[0]['cp']; ?> <?php echo $cmd[0]['ville']; ?></p>
                            </div>
                        </div>
                        <hr>

                        <div id='cart' class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h2><i class="fas fa-shopping-cart"></i></h2>
                            <?php
                            $cart = GetTableSpe($database, "cart", 'user', $_SESSION['login'][0]);
                            $i = 0;
                            $total = 0;
                            while ($i < count($cart)) {
                                $article = GetTableSpe($database, 'articles', 'id', $cart[$i]['article']);
                                echo "<p class='cmd_list col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12'><i class=\"far fa-check-circle\"></i> <strong>" . $article[0]['nom'] . "</strong> (".$article[0]['prix']."€) x <strong>" . $cart[$i]['quantity'] . "</strong><span id='prix' class='right'>".($article[0]['prix'] * $cart[$i]['quantity'])."€</span></p>";
                                $total += ($article[0]['prix'] * $cart[$i]['quantity']);
                                $i++;
                            }
                            if ($i != 0)
                                echo "<hr class='col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12'><span id='prix_tot' class='right col-sm-9 col-xs-9 col-md-9 col-lg-9 col-xl-9'>Prix total :</span><span id='prix_tot' class='right col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xl-3'><strong>".$total."€</strong></span>";
                            else
                                echo "Aucun article dans le panier";
                            ?>
                        </div>
                        <div class="continue col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <a href="?cmd_usr=<?php echo $_GET['cmd_usr']; ?>&part=3" class="continue"><i class="fas fa-arrow-circle-right"></i> Procéder au paiement</a>
                            <a href="?cmd_usr=<?php echo $_GET['cmd_usr']; ?>&part=1" class="previous"><i class="fas fa-arrow-circle-left"></i> Précédent</a>
                        </div>
                    <?php
                    }
                    else {
                        if ($_GET['part'] == 3) {
                            // Partie paiement
                            ?>
                                <h2 class="centered">Paiement</h2>
                                <?php
                                    if (isset($_POST['submit'])) {
                                        extract($_POST);
                                        $code = $c1.$c2.$c3.$c4;
                                        echo $code;
                                        if (strlen($code) == 16 && strlen($cc) == 3) {
                                            $cart = GetTableSpe($database, "cart", "user", $_SESSION['login'][0]);
                                            $i = 0;
                                            while ($i < count($cart)) {
                                                $article = GetTableSpe($database, "stocks", "id", $cart[$i]['article']);
                                                db_updateValue($database, "stocks", "quantite", ($article[0]['quantite'] - $cart[$i]['quantity']), 'id', $cart[$i]['article']);
                                                $i++;
                                            }
                                            DeleteValue($database, "cart", "user", $_SESSION['login'][0]);
                                            header("Location: index.php?cmd=success");
                                        }
                                        else {
                                            echo "Information bancaire non reconnut";
                                        }
                                    }
                                ?>
                                <div id='info' class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                                    <form id="paiement" action="" method="post" class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 row">
                                            <label class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">N° de carte :</label>
                                            <input name="c1" type="text" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" maxlength="4" minlength="4" required>
                                            <input name="c2" type="text" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" maxlength="4" minlength="4" required>
                                            <input name="c3" type="text" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" maxlength="4" minlength="4" required>
                                            <input name="c4" type="text" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" maxlength="4" minlength="4" required>
                                            <label class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">Date d'expiration :</label>
                                            <select name="me" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <select name="ae" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                            </select>
                                        <label class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">Cryptogramme :</label>
                                        <input name="cc" type="text" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" maxlength="3" minlength="3">
                                        <button name="submit">Payer</button>
                                    </form>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                                </div>

                             <?php
                        }
                    }
                }
        }?>
    </div>
</div>
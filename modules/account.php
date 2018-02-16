<div id="create_account_container" class="container">
    <div id="create_account_row" class="row">
        <h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 create_account_title" id="create_account">Créer votre compte</h1>
        <form class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 row" action="" method="post">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <h2 id="create_account">Informations personnelles</h2>
                <p><label for="prenom">Prénom : </label></p><p><input type="text" id="prenom" name="firstname" placeholder="Ex : Yaho" required></p>
                <p><label for="nom">Nom : </label></p><p><input type="text" id="nom" name="lastname" placeholder="Ex : Merle" required></p>


                <h2 id="create_account">Mot de passe</h2>
                <p><label for="mdp">Mot de passe : </label></p><p><input type="password" id="mdp" name="password" placeholder="Entrer votre mot de passe" required></p>
                <p><label for="confmdp">Confirmer mot de passe : </label></p><p><input type="password" id="confmdp" name="passwords" placeholder="Confirmer mot de passe" required></p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <h2 id="create_account">Coordonnées</h2>
                <p><label for="email">Email : </label></p><p><input type="email" id="email" name="email" placeholder="Ex : abdoulaye.toure@gmail.com" required></p>
                <p><label for="tel">Téléphone : </label></p><p><input type="tel" id="tel" name="phone" placeholder="Ex : +33656789856"></p>
                <h2 id="create_account">Lieu de résidence</h2>
                <p><label for="numrue">Adresse : </label></p><p><input type="text" id="numrue" name="streetNumber" placeholder="Ex : 1"><input type="text" id="rue" name="street" placeholder="Ex : boulevard Nicodev"></p>
                <p><label for="cp">Code postal : </label></p><p><input type="text" id="cp" name="posteCode" placeholder="Ex : 44470"></p>
                <p><label for="ville">Ville : </label></p><p><input type="text" id="ville" name="city" placeholder="Ex : Nantes"></p>
                <p><label for="pays">Pays : </label></p><p><input type="text" id="pays" name="country" value="FRANCE" required></p>

            </div>
            <button class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" name="register" type="submit">Créer un compte</button>
        </form>
    </div>
</div>

<?php
    if (isset($_POST['register'])) {
        if(empty($_POST)){
            $_SESSION["error_message"] = "Veuillez remplir le formulaire.";
            header("Refresh: 0");
        }
        else {
            try {
                extract($_POST);
                if ($password == $passwords) {
                    $database->exec("INSERT INTO `users` (`email`, `password`, `nom`, `prenom`, `telephone`, `numrue`, `rue`, `cp`, `ville`, `pays`) VALUES ('$email', '$password', '$firstname', '$lastname', '$phone', '$streetNumber', '$street', '$posteCode', '$city', '$country')");
                    header("Refresh: 0");
                }
            } catch (PDOException $e) {
                $_SESSION["error_message"] = "Erreur";
                header("Refresh: 0");
            }
        }

    }
?>
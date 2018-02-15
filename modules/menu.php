<ul id="menu">
    <li class="menu_item_pri">Home</li>
    <li class="menu_item_pri">Espace Membres
        <ul id="menu_sub">
            <li class="menu_item_sub">
                <form action="treatment.php" method="post">
                    <h2>Se connecter</h2>
                    <p><label for="email">Email</label><input type="text" id="email" name="email" placeholder="Entrer votre email"></p>
                    <p><label for="mdp">Mot de passe</label><input type="password" id="mdp" name="password" placeholder="Entrer votre mot de passe"><p>
                    <input name="" type="submit">
                </form>
            </li>
            <li class="menu_item_sub">

            </li>
        </ul>
    </li>
</ul>

<style>
    #menu {
        display: inline-block;
        width: 100%;
        height: 50px;
        text-align: right;
        line-height: 50px;
        padding: 0;
        position: fixed;
    }


    .menu_item_pri {
        width: 25%;
        padding: 0;
        text-align: center;
        display: inline-block;
    }

    .menu_item_pri:hover>#menu_sub {
        display: block;
    }

    #menu_sub {
        padding: 0;
        display: none;
    }

    .menu_item_sub {
        padding: 0;
    }

    .menu_item_sub>form {
        width: 100%;
        line-height: 30px;
    }

    .menu_item_sub>form>p>label {
        float: left;
        height: 30px;
        width: 50%;
    }
    .menu_item_sub>form>p>input {
        float: right;
        height: 30px;
        width: 50%;
    }
    .menu_item_sub+button {
        width: 50%;
        float: right;
        height: 30px;
    }

</style>
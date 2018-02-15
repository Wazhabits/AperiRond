<?php
session_start();

include "pdo.php";

//$userAllowed = [];

$accounts = $pdo->query("SELECT * FROM users");

while($row = $accounts->fetch(PDO::FETCH_ASSOC)){
    $userAllowed = $row;
}

if(!empty($_POST["email"]) && !empty($_POST["password"])){
    if(($userAllowed['email'] != $_POST['email']
            || md5($userAllowed['password']) != md5($_POST['password']))
        || ($userAllowed['email'] != $_POST['email']
            && md5($userAllowed['password']) != md5($_POST['password']))) {
        $_SESSION['error_message'] = "Email/Mot de passe incorrect.";
        header("Location: ../login.php");
    }
    else {
        $_SESSION['login'] = true;

        header("Location: index.php");
    }
}
else {
    $_SESSION["error_message"] = "Veuillez remplir tous les champs.";
    header("Location: ../login.php");
}


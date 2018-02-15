<?php
/**
 * Created by PhpStorm.
 * User: alexi
 * Date: 14/02/2018
 * Time: 12:31
 */

try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=aperirond", "root", "");
}
catch (PDOException $e) {
    $_SESSION['error_message'] = "Erreur fatale";
    header('Location: /index.php');
}
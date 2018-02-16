<?php
/**
 * Created by PhpStorm.
 * User: Wazhabits
 * Date: 15/02/2018
 * Time: 14:17
 */
$sql = "DELETE FROM `cart` WHERE id = ".$_GET['del_cart']." AND user = 1";
if ($database->query($sql) == false)
    echo "error";
header("Location: index.php");
<?php
/**
 * Created by PhpStorm.
 * User: Wazhabits
 * Date: 15/02/2018
 * Time: 14:17
 */
$sql = "DELETE FROM `cart` WHERE id = ".$_GET['del_cart']." AND user =  " . $_SESSION['login'][0];
if ($database->query($sql) == false)
    echo "error ".$sql;
if (isset($_GET['cmd_usr']))
    header('Location: index.php?cmd_usr='.$_GET['cmd_usr']);
else
    header("Location: index.php");
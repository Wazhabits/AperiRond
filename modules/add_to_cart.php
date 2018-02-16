<?php
    $result_cart = $database->query("SELECT * FROM cart WHERE user = 1 AND article = '".$_GET['add_to_cart']."'");
    $result_cart = $result_cart->fetchAll();
    $stock = GetTableSpe($database, 'stocks', 'id', $_GET['add_to_cart']);
    if (count($result_cart) == 0) {
        $fields = array(3);
        $values = array(3);
        $fields[0] = "user";
        $fields[1] = "article";
        $fields[2] = "quantity";
        $values[0] = 1;
        $values[1] = $_GET['add_to_cart'];
        $values[2] = $_POST['quantity'];
        InsertValues($database, "cart", $fields, $values);
    }
    else {
        if (($result_cart[0][3] + $_POST['quantity']) <= $stock[0][1]) {
            $update = "UPDATE cart SET quantity = " . ($result_cart[0][3] + $_POST['quantity']) . " WHERE user = 1 AND article = " . $_GET['add_to_cart'];
            $database->query($update);
        }
        else
        {
            $update = "UPDATE cart SET quantity = " . $stock[0][1] . " WHERE user = 1 AND article = " . $_GET['add_to_cart'];
            $database->query($update);
        }
    }
header("Location: index.php");
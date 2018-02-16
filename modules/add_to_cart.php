<?php
    $result_cart = $database->query("SELECT * FROM cart WHERE user = " . $_SESSION['login'][0] . " AND article = '".$_GET['add_to_cart']."'");
    $result_cart = $result_cart->fetchAll();
    print_r($result_cart);
    $stock = GetTableSpe($database, 'stocks', 'id', $_GET['add_to_cart']);
    if (count($result_cart) == 0) {
        echo "ici";
        $fields = array(4);
        $values = array(4);
        $fields[0] = "user";
        $fields[1] = "article";
        $fields[2] = "quantity";
        $fields[3] = "end";
        $values[0] = $_SESSION['login'][0];
        $values[1] = $_GET['add_to_cart'];
        $values[2] = $_POST['quantity'];
        $values[3] = 0;
        InsertValues($database, "cart", $fields, $values);
    }
    else {
        if (($result_cart[0][3] + $_POST['quantity']) <= $stock[0][1]) {
            $update = "UPDATE cart SET quantity = " . ($result_cart[0][3] + $_POST['quantity']) . " WHERE user = " . $_SESSION['login'][0] . " AND article = " . $_GET['add_to_cart'];
            $database->query($update);
        }
        else
        {
            $update = "UPDATE cart SET quantity = " . $stock[0][1] . " WHERE user = " . $_SESSION['login'][0] . " AND article = " . $_GET['add_to_cart'];
            $database->query($update);
        }
    }
header("Location: index.php");
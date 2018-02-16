<?php

function GetTable($database, $table) {
    $sql = "SELECT * FROM " . $table;
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return ($result);
}

function GetTableSpe($database, $table, $field, $value) {
    $sql = "SELECT * FROM " . $table . " WHERE " . $field . " = " . $value;
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return ($result);
}

function InsertValues($_db_connected, $_table, $_fields, $_values){
    $i = 0;
    $sql = "INSERT INTO ".$_table." (";
    while ($i < count($_fields)) {
        if ($i < count($_fields) - 1)
            $sql = $sql.$_fields[$i].", ";
        else
            $sql = $sql.$_fields[$i].")";
        $i++;
    }
    $sql = $sql." VALUES ('";
    $i = 0;
    while ($i < count($_values)) {
        if ($i < count($_values) - 1)
            $sql = $sql.$_values[$i]."', '";
        else
            $sql = $sql.$_values[$i]."')";
        $i++;
    }
    if ($_db_connected->query($sql) == false)
        return false;
    return true;
}

function DeleteValue($_db_connected, $_table, $_field, $_value) {
    $sql = "DELETE FROM `".$_table."` WHERE ".$_field." = ".$_value;
    if ($_db_connected->query($sql) == false)
        return false;
    return true;
}
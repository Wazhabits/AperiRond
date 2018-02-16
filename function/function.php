<?php
// Fonction SELECT * d'une table
function GetTable($database, $table) {
    $sql = "SELECT * FROM " . $table;
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return ($result);
}

// FONCTION SELECT * D'une TABLE WHERE x = y
function GetTableSpe($database, $table, $field, $value) {
    $sql = "SELECT * FROM " . $table . " WHERE " . $field . " = " . $value . " ORDER BY id DESC";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return ($result);
}

// Fonction ajouter des valeurs

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

// FONCTION SUPPRIMER DES DONNEES


function DeleteValue($_db_connected, $_table, $_field, $_value) {
    $sql = "DELETE FROM `".$_table."` WHERE ".$_field." = ".$_value;
    if ($_db_connected->query($sql) == false)
        return false;
    return true;
}

// MAJ DES DONNEES

function db_updateValue($_db_connected, $_table, $_field, $_value, $col, $_id) {
    $sql = "UPDATE ".$_table." SET ".$_field." = '".$_value."' WHERE ".$col." = ".$_id;
    if ($_db_connected->query($sql) == false)
        return false;
    return true;
}

function UpdateValues($_db_connected, $_table, $_fields, $_values, $_field,  $_id) {
    $i = 0;
    if (count($_fields) != count($_values))
        return false;
    while ($i < count($_fields)) {
        if (db_updateValue($_db_connected, $_table, $_fields[$i], $_values[$i], $_field, $_id) == false)
            return false;
        $i++;
    }
    return true;
}
<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);

include_once __DIR__ . "/functions.php";


if (isset($_POST['id'])) {
    $id=$_POST['id'];
    $connection = getDataBaseConnection();
    $sql = "DELETE FROM products WHERE id=$id";
    $connection->query($sql);
    echo json_encode(['success'=>true]);
}

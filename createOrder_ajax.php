<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);

include_once __DIR__ . "/functions.php";


if (isset($_COOKIE['basket']) && count(json_decode($_COOKIE['basket'], true)) > 0) {
    $basket = json_decode($_COOKIE['basket'], true);
    $price = getFullPrice($basket);
    $userId = $_SESSION['user']['id'];
    $time = time();
    $connection = getDataBaseConnection();
    $sql = "INSERT INTO orders (user, price, time, products) VALUES ($userId ,$price, $time ,'" . quotemeta($_COOKIE['basket']) . "')";
    $connection->query($sql);
    echo $sql;
}

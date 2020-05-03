<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . "/functions.php";

/**
 * Created by PhpStorm.
 * User: Анастасия
 * Date: 07.03.2020
 * Time: 19:10
 */


function sst()
{
    ob_start();
    ?>
    <h1>Страница заказа</h1>
    <br>
    <?php
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $connection = getDataBaseConnection();
        $person = $connection->query("SELECT * FROM users WHERE id='" . $user['id'] . "'")->fetch_assoc();
        $name = $person['name'];
        $phone = $person['phone'];
        ?>
        <h3>Ваш логин: <?= $name ?></h3>
        <h3>Ваш телефон: <?= $phone ?></h3>
        <?php
        if(isset($_COOKIE['basket']) && count(json_decode($_COOKIE['basket'], true)) > 0){
            ?>
            <h3>Сумма заказа: <?= getFullPrice(json_decode($_COOKIE['basket'],true)) ?></h3>
            <button onclick="createOrder()">Заказать</button>
            <?php
        }
        else{
            ?>
            <h3>В корзине пусто</h3>
            <?php
        }
    } else {
        ?>
        Войдите под своим аккаунтом
        <?php
    }
    return ob_get_clean();
}

show(sst());

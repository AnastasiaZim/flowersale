<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);

include_once __DIR__ . "/functions.php";

function sst()
{
    ob_start();
    ?>
    <h1>Личный кабинет</h1>
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
        <br><br>
        <?php
        if ($user['status'] !=1) {
            ?>
            <a href="basket.php">Корзина</a><br>  <?php
        } ?>
        <a href="history.php">История заказов</a>
        <?php
        if ($user['status'] ==1) {
            ?>
            <a href="editor.php">Редактор</a><br>  <?php
        }
    } else {
        ?>
        Войдите под своим аккаунтом
        <?php
    }
    return ob_get_clean();
}

show(sst());

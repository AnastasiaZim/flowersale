<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . "/functions.php";

function editProduct($product)
{
    $name = $product['ProductName'];
    $photo = $product['Img'];
    $price = $product['Price'];
    $comment = $product['comment'];
    ?><div class="col-2"><?= $name ?></div>
    <div class="col-2"><img src="<?= $photo ?>" height="100px" width="100px"></div>
    <div class="col-2"><?= $price ?> руб./шт</div>
    <div class="col-4"><?= $comment ?></div>
    <div class="col-2">
        <button class="buttonIn" onclick="">Удалить</button><br>
        <button class="buttonIn" onclick="">Редактировать</button>
    </div>
    <?php
}

function sst()
{
    ob_start();
    ?>
    <h1>Редактор</h1>
    <br>
    <?php
    $connection = getDataBaseConnection();
    $products = $connection->query("SELECT * FROM products WHERE true ")->fetch_all(MYSQLI_ASSOC);
    ?>
    <button class="buttonIn" onclick="">Добавить продукт</button>
    <div class="row"><?php
    foreach ($products as $product) {
        editProduct($product);
    }
    ?>
    </div>

    <?php
    return ob_get_clean();
}

show(sst());

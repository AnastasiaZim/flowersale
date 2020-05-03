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
    $id = "";
    $productName = "";
    $img = "";
    $price = "";
    $comment = "";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $product = getDataBaseConnection()->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
        if (!$product) {
            die("Такого продукта нет");
        }
        $productName = $product['ProductName'];
        $img = $product['Img'];
        $price = $product['Price'];
        $comment = $product['comment'];
    }
    ?>
    <h1>Внесение данных</h1>
    <br>
    <form id="edit_form">
        <input hidden name="id" value="<?= $id ?>">
        <label>Название
            <input type="text" name="name" value="<?= $productName ?>"/>
        </label><br>
        <label>Ссылка на картинку
            <input type="text" name="img" value="<?= $img ?>"/>
        </label><br>
        <label>Цена
            <input type="number" name="price" value="<?= $price ?>">
        </label><br>
        <label>Описание
            <textarea cols="50" rows="10" name="comment"><?= $comment ?></textarea>
        </label><br>
        <button type="button" class="btn btn-primary" onclick="createProduct()">Внести данные</button>
    </form>

    <?php
    return ob_get_clean();
}

show(sst());

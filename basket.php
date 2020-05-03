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
    <h1>Корзина</h1>
    <br>
    <?php
    if (isset($_COOKIE['basket']) && count(json_decode($_COOKIE['basket'], true)) > 0) {
        $basket = json_decode($_COOKIE['basket'], true);

        ?>
        <div class="container-fluid basket">
            <div class="row">
                <div class="col-2">Название</div>
                <div class="col-2">Количество</div>
                <div class="col-2">Цена</div>
                <div class="col-2">Стоимость</div>
                <div class="col-2">Удалить</div>
            </div>
        </div>
        <?php
        $sumCount = 0;
        $sumPriceCount = 0;
        foreach ($basket as $basketItem) {
            if($basketItem!=null){
                $product = $basketItem['product'];
                $count = $basketItem['count'];
                $PriceCount = $product['Price'] * $count;
                $sumCount += $count;
                $sumPriceCount += $PriceCount;
                ?>
                <div class="container-fluid basket">
                    <div class="row">
                        <div class="col-2"><?= $product['ProductName'] ?></div>
                        <div class="col-2"><?= $product['Price'] ?></div>
                        <div class="col-2"><?= $count ?></div>
                        <div class="col-2"><?= $PriceCount ?></div>
                        <div class="col-2" onclick="deleteBasketItem(<?=$product['id']?>)">x</div>
                    </div>
                </div>


                <?php
            }

        }
        ?>
        <br>
        <div class="container-fluid basket">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-2">Сумма</div>
                <div class="col-2"><?= $sumCount ?></div>
                <div class="col-2"><?= $sumPriceCount ?></div>
                <div class="col-2">x</div>
            </div>
        </div>
        <a href="order.php">Заказать</a>
        <?php

    } else {
        echo "В корзине ничего нет";
    }

    return ob_get_clean();
}

show(sst());

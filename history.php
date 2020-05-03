<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . "/functions.php";



function sst()
{
    ob_start();
    ?>
    <h1>История заказов</h1>
    <br>
    <?php
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $connection = getDataBaseConnection();
        if ($user['status'] == 1) {
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">Id заказчика</div>
                    <div class="col">Стоимость</div>
                    <div class="col">Время</div>
                    <div class="col">Название и количество</div>
                </div>
            </div><br>
            <?php
            $history = $connection->query("SELECT orders.*, users.name AS user_name FROM orders INNER JOIN users ON orders.user=users.id")->fetch_all(MYSQLI_ASSOC);
            foreach ($history as $order) {
                $products = json_decode($order['products'], true);

                ?>
                <div class="container-fluid">
                <div class="row">
                    <div class="col"><?= $order['user_name'] ?></div>
                    <div class="col"><?= $order['price'] ?></div>
                    <div class="col"><?= date('d.m.Y H:i:s', $order['time']); ?></div>
                    <div class="col">
                        <?php
                        foreach ($products as $basketItem) {
                            $count = $basketItem['count'];
                            $product = $basketItem['product'];
                            $name = $product['ProductName'];
                            ?><?= $name ?> в количестве <?= $count ?><br><?php
                        }
                        ?>
                    </div>
                </div>
                </div><?php
            }

        } else {
            $history = $connection->query("SELECT * FROM orders WHERE user='" . $user['id'] . "'")->fetch_assoc();

            if (isset($history)) {
                $products = json_decode($history['products'], true);
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">Стоимость</div>
                        <div class="col">Время</div>
                        <div class="col">Название и количество</div>
                    </div>
                </div><br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col"><?= $history['price'] ?></div>
                        <div class="col"><?= date('Y-m-d H:i:s', $history['time']); ?></div>
                        <div class="col">
                            <?php
                            foreach ($products as $basketItem) {
                                $count = $basketItem['count'];
                                $product = $basketItem['product'];
                                $name = $product['ProductName'];
                                ?><?= $name ?> в количестве <?= $count ?><br><?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                echo "История пуста";
            }

        }

    } else {
        ?>
        Войдите под своим аккаунтом
        <?php
    }
    return ob_get_clean();
}

show(sst());

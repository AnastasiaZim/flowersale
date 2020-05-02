<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . "/functions.php";



function sst()
{
    ob_start();
    $get_id=$_GET['id'];
    $connection = getDataBaseConnection();
    $product = $connection->query("SELECT * FROM products WHERE id=$get_id")->fetch_assoc();
    $name = $product['ProductName'];
    $photo = $product['Img'];
    $price = $product['Price'];
    $comment = $product['comment'];
?>
    <div class="container-fluid product">
        <a href="catalog.php" ><h6><-Назад</h6></a>
        <div class="row">
            <div class="col-5">
                <img src="<?= $photo ?>" height="280px" width="300px"><br>
                <h5><?= $price ?> руб./шт</h5><br>
            </div>
            <div class="col-5">
                <h4><?= $name ?></h4><br>
                <h5><?= $comment ?></h5>
            </div>
        </div>


    </div>
<?php
    return ob_get_clean();
}

show(sst());

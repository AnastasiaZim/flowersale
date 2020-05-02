<?php
include_once __DIR__ . "/functions.php";
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
/**
 * Created by PhpStorm.
 * User: Анастасия
 * Date: 07.03.2020
 * Time: 19:10
 */

function drawProduct($product)
{
    $name = $product['ProductName'];
    $photo = $product['Img'];
    $price = $product['Price'];
    ?>
    <h4><?= $name ?></h4><br>
    <img src="<?= $photo ?>" height="180px" width="200px"><br>
    <a href="product.php?id=<?=$product['id']?>">подробнее</a><br>
    <h5><?= $price ?> руб./шт</h5><br>
    <?php
}


function sst()
{
    ob_start();
    ?>
    <h1>Каталог</h1>
    <br>
    <?php
    $connection = getDataBaseConnection();
    $products = $connection->query("SELECT * FROM products WHERE true ")->fetch_all(MYSQLI_ASSOC);
    ?>
    <div class="row"><?php
    foreach ($products as $product) {
        ?>
        <div class="col-4"<?php
        drawProduct($product);
        ?></div><?php
    }
    ?>
    </div>
    <!---->
    <div id="result_form"></div>
    <!---->
    <?php
    if (isset($_SESSION['user'])) {
    }
    return ob_get_clean();
}

show(sst());
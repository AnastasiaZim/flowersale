<?php
/**
 * Created by PhpStorm.
 * User: Анастасия
 * Date: 30.04.2020
 * Time: 23:38
 */

function getDataBaseConnection()
{
    $connection = new mysqli("45.84.224.17", "admin_flowersale", "89118911", "admin_flowersale");
    $connection->set_charset("utf8");
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}

session_start();

function show($s)
{
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="ajax.js"></script>
    <link href="style.css" rel="stylesheet">

    <div class="container-fluid c1"></div>
    <div class="container-fluid c11">

        <!--<p><a href="index.php"> Войти </a></p>-->
        <?php
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            ?>
            Вы вошли как <?= $user['name'] ?>
            <a href="/unlogin.php">
                <button class="buttonIn">Выйти</button>
            </a>
            <?php
        } else {
            ?>
            <button class="buttonIn" data-toggle="modal" data-target="#myModal">Войти</button>
            <?php
        }
        ?>
    </div>

    <div class="container-fluid c2">
        <div class="row">
            <div class="col-2 c22">
                <a href="index.php">
                    <h5> Главная </h5>
                </a>
                <a href="catalog.php">
                    <h5> Каталог </h5>
                </a>
                <?php
                if (!isset($_SESSION['user'])) {
                    ?>

                    <a href="registration.php">
                        <h5> Регистрация </h5>
                    </a>

                    <?php
                }
                ?>
                <a href="selfBox.php">
                    <h5> Личный кабинет </h5>
                </a>
            </div>
            <div class="col c23">
                <?php echo $s ?>
            </div>
        </div>

    </div>
    <div class="container-fluid c3"> Автор: Анастасия <br> Наталья</div>
    <?php
    drawModal();
}

function drawModal()
{
    ?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Вход на сайт</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="ajax_form" action="">
                        <input type="text" name="name" placeholder="LOGIN"/><br>
                        <input type="text" name="password" placeholder="PASSWORD"/><br>
                        <div id="auth_error"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn">Войти</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function getFullPrice($basket)
{
    $sumPriceCount = 0;
    foreach ($basket as $basketItem) {
        $product = $basketItem['product'];
        $count = $basketItem['count'];
        $PriceCount = $product['Price'] * $count;
        $sumPriceCount += $PriceCount;
    }
    return $sumPriceCount;
}

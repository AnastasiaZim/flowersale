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
    <h1>Главная</h1>
    <br>
    <!---->
    <div id="result_form"></div>
    <!---->
    <?php
    return ob_get_clean();
}

show(sst());

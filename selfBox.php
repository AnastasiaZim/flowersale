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
    <!---->
    <div id="result_form"></div>
    <!---->
    <?php
    return ob_get_clean();
}

show(sst());

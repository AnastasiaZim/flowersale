<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . "/functions.php";


function sst()
{
    ob_start();
    ?>
    <h1>Регистрация</h1>
    <br>
    <div class="container-fluid">
        <form id="register_form">
            <input type="text" class="form-control" name="name" placeholder="LOGIN"/><br>
            <input type="text" class="form-control" name="password" placeholder="PASSWORD"/><br>
            <input type="text" class="form-control" name="phone" placeholder="PHONE"/><br>
            <button type="button" class="btn btn-primary" onclick="register()">Зарегистрироваться</button>
            <div id="register_result"></div>
        </form>
    </div>
    <?php
    return ob_get_clean();
}

show(sst());

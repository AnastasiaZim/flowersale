<?php
/**
 * Created by PhpStorm.
 * User: Анастасия
 * Date: 01.05.2020
 * Time: 0:42
 */
session_start();
unset($_SESSION['user']);
header("Location: /"); /* Перенаправление браузера */

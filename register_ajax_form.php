<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);

include_once __DIR__ . "/functions.php";
if (isset($_POST["name"]) && mb_strlen($_POST['name'])>3 && isset($_POST["password"]) && mb_strlen($_POST['password'])>3 && isset($_POST["phone"]) && mb_strlen($_POST['phone'])>8) {
    $name = $_POST['name'];
    $shaPassword = sha1($_POST['password']);
    $phone = $_POST['phone'];
    $sql = "SELECT * FROM users WHERE name='" . $name . "'";
    $connection = getDataBaseConnection();
    $res = $connection->query($sql)->fetch_assoc();
    if ($res) {
        echo json_encode(['error' => 'Пользователь с таким логином уже есть']);
    } else {
        $connection->query("INSERT INTO users (name, password, phone,status) VALUES ('" . $name . "','" . $shaPassword . "','" . $phone . "',0)");
        $sql = "SELECT * FROM users WHERE name='" . $name . "' AND password='" . $shaPassword . "'";
        $user = $connection->query($sql)->fetch_assoc();
        if($user){
            $_SESSION['user']=$user;
            echo json_encode($user);
        }
        else{
            echo json_encode(['error' => 'Не удалось создать пользователя"']);
        }
    }
} else {
    echo json_encode(['error' => 'Заполните все поля"']);
}
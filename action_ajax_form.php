<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);

include_once __DIR__ . "/functions.php";
if (isset($_POST["name"]) && isset($_POST["password"])) {
    $name = $_POST['name'];
    $shaPassword = sha1($_POST['password']);
    $sql = "SELECT * FROM users WHERE name='" . $name . "' AND password='" . $shaPassword . "'";
    $res = getDataBaseConnection()->query($sql);
    if ($res) {
        $user = $res->fetch_assoc();
        $_SESSION['user'] = $user;
        echo json_encode($user);
    } else {
        echo json_encode(false);
    }
}

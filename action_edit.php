<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);

include_once __DIR__ . "/functions.php";


if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name=$_POST['name'];
    $img=$_POST['img'];
    $price=$_POST['price'];
    $comment=$_POST['comment'];
    if($id==''){
        $id='null';
    }
    $connection = getDataBaseConnection();
    $sql = "INSERT INTO products (id, ProductName, Img, Price, comment) VALUES ($id,'$name','$img',$price,'$comment') ON DUPLICATE KEY UPDATE ProductName='$name',Img='$img',Price=$price,comment='$comment'";
    $connection->query($sql);
    echo json_encode(['success' => true]);
}

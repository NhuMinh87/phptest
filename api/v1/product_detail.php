<?php
require_once("utils/db.php");
require_once("utils/helpers.php");
$id = $_GET["id"];
$sql = "select * from products where id = $id;";
$data = query($sql);
if(count($data) > 0){
    $product = $data[0];
    sendJsonResponse($product);// không truyền status thì tự nhận là 200
}else{
    sendErrorResponse("Product not found!");
}


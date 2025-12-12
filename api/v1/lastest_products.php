<?php
require_once("utils/db.php");
require_once("utils/helpers.php");

$sql = "select * from products order by id desc limit 10;";
$data = query($sql);

sendJsonResponse($data); //không truyền status thì tự nhận là 200
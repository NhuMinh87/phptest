<?php
require_once('utils/db.php');
require_once('utils/helpers.php');

header('Content-Type: application/json');
//lấy nội dung json từ request body
$json_data = file_get_contents('php://input');
//chuyển json thành mảng php
$_POST = json_decode($json_data, true);

$customer_name = $data["customer_name"];
$customer_address = $data["customer_address"];
$customer_tel = $data["customer_tel"];
$payment_method = $data["payment_method"];
$paid = 0;

$cart = $_POST["cart"]; // mảng các sp trong giỏ hàng

$grand_total = 0;
foreach($cart as $item){
    $grand_total += $item["price"] * $item["buy_qty"];
}

$now = date("YYYY-MM-DD H:i:s");
$sql = "INSERT INTO orders(customer_name, customer_address, customer_tel, create_at, payment_method, paid, grand_total)
        VALUES('$customer_name', '$customer_address', '$customer_tel','$now', '$payment_method', $paid, $grand_total)";
$order_id = queryUpdate($sql);
// thêm các dữ liệu bảng order_products
foreach($cart as $item){
    $product_id = $item["id"];
    $buy_qty = $item["buy_qty"];
    $sql = "INSERT INTO order_products(order_id, product_id, price, buy_qty)
            VALUES($order_id, $product_id, $price, $buy_qty)";
    queryUpdate($sql_item);
}
sendJsonResponse();

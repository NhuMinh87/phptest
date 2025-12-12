<?php
session_start();

// Lấy id sản phẩm từ URL
if (!isset($_GET["id"])) {
    die("Thiếu ID sản phẩm!");
}

$product_id = $_GET["id"];

// Kết nối DB
$conn = new mysqli("localhost", "root", "root", "T2507E");

// Lấy sản phẩm từ DB
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

// Nếu sản phẩm không tồn tại
if (!$product) {
    die("Không tìm thấy sản phẩm!");
}

// Nếu giỏ hàng chưa có → tạo mảng rỗng
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Nếu sản phẩm đã có → tăng số lượng
if (isset($_SESSION["cart"][$product_id])) {
    $_SESSION["cart"][$product_id]["qty"]++;
} else {
    $_SESSION["cart"][$product_id] = [
        "id" => $product["id"],
        "name" => $product["name"],
        "price" => $product["price"],
        "qty" => 1,
        "thumbnail" => $product["thumbnail"]
    ];
}

// Chuyển sang trang giỏ hàng
header("Location: cart.php");
exit;

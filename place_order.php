<?php
session_start();  // BẮT BUỘC PHẢI CÓ

// KHẮC PHỤC LỖI 1: Form không gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Sai phương thức gửi form!");
}

// Lấy dữ liệu từ form
$fullname = $_POST["fullname"] ?? null;
$email    = $_POST["email"] ?? null;
$phone    = $_POST["phone"] ?? null;
$address    = $_POST["address"] ?? null;

// Kiểm tra dữ liệu rỗng
if (!$fullname || !$email || !$phone || !$address) {
    die("Thiếu thông tin! Vui lòng quay lại trang checkout.");
}

// KHẮC PHỤC LỖI 2: Giỏ hàng không tồn tại
$cart = $_SESSION["cart"] ?? null;
if (!$cart) {
    die("Giỏ hàng rỗng, không thể đặt hàng!");
}

// Tính tổng tiền
$total = 0;
foreach ($cart as $item) {
    $total += $item["price"] * $item["qty"];
}

// Kết nối DB
$conn = new mysqli("localhost", "root", "root", "T2507E");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lưu vào bảng orders
$sql = "INSERT INTO orders(fullname, email, phone, address, total_price)
        VALUES ('$fullname', '$email', '$phone', '$address', $total)";

$conn->query($sql);
$order_id = $conn->insert_id;

// Lưu sản phẩm vào order_items
foreach ($cart as $item) {

    $pid  = $item["id"];
    $qty  = $item["qty"];
    $price = $item["price"];

    $conn->query("
        INSERT INTO order_items(order_id, product_id, qty, price)
        VALUES($order_id, $pid, $qty, $price)
    ");
}

echo "Đặt hàng thành công! Mã đơn hàng: " . $order_id;

// Xóa giỏ hàng sau khi đặt
unset($_SESSION["cart"]);
?>

<?php
session_start();

// Nếu giỏ hàng rỗng
if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    die("Giỏ hàng trống! <a href='list.php'>Quay lại mua hàng</a>");
}

$cart = $_SESSION["cart"];

// Tính tổng tiền
$total = 0;
foreach ($cart as $item) {
    $total += $item["price"] * $item["qty"];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">🛒 Thông tin thanh toán</h2>

    <div class="row">

        <!-- GIỎ HÀNG -->
        <div class="col-md-6">
            <h4>Giỏ hàng của bạn</h4>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>SL</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                    <tr>
                        <td><?php echo $item["name"]; ?></td>
                        <td><?php echo $item["qty"]; ?></td>
                        <td><?php echo number_format($item["price"]); ?> đ</td>
                        <td><?php echo number_format($item["price"] * $item["qty"]); ?> đ</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h4 class="text-end">
                Tổng tiền: 
                <strong class="text-danger">
                    <?php echo number_format($total); ?> đ
                </strong>
            </h4>
        </div>

        <!-- FORM CHECKOUT -->
        <div class="col-md-6">
            <h4>Thông tin khách hàng</h4>

            <form action="place_order.php" method="POST" class="mt-3">

                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ giao hàng</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Đặt hàng ngay
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

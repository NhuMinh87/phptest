<?php
session_start();

$cart = $_SESSION["cart"] ?? [];

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <h2 class="mb-3">🛒 Giỏ hàng của bạn</h2>

    <?php if (empty($cart)): ?>
        <p>Giỏ hàng trống! <a href="list.php">Quay lại mua hàng</a></p>
    <?php else: ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>SL</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cart as $item):
                    $total += $item["price"] * $item["qty"];
                ?>
                <tr>
                    <td><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["qty"]; ?></td>
                    <td><?php echo number_format($item["price"]); ?> đ</td>
                    <td><?php echo number_format($item["price"] * $item["qty"]); ?> đ</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="text-end">Tổng tiền: <span class="text-danger"><?php echo number_format($total); ?> đ</span></h4>

        <a href="checkout.php" class="btn btn-primary mt-3">Tiến hành thanh toán</a>

    <?php endif; ?>

</div>

</body>
</html>

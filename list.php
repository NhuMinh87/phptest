<?php
$list = [
[
    "id"=> 1,
    "name" => "iPhone 17 Pro Max 2TB",
    "price" => 4999,
    "qty" => 10,
    "image" => "images/iphone17.png"
],
[
    "id"=> 2,
    "name" => "iPhone 16 Pro Max 2TB",
    "price" => 3999,
    "qty" => 15,
    "image" => "images/iphone17.png"
],
[
    "id"=> 3,
    "name" => "iPhone 15 Pro Max 2TB",
    "price" => 2999,
    "qty" => 8,
    "image" => "images/iphone17.png"
]    
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo sản phẩm</title>
    <?php include("html/style.php"); ?>
</head>
<body>
    <section>
        <?php foreach($list as $product): ?>
        <div class="container">
            <h1><?php echo $product ["name"];?></h1>
            <img src="<?php echo $product ["image"];?>" alt="<?php echo $product ["name"];?>" width="300">
            <p>$<?php echo $product ["price"];;?></p>
            <?php if($product ["qty"] > 0) :?>
            <p class="text-success">Còn hàng!</p>
            <?php else:?>
            <p class="text-danger">Hết hàng!</p>
            <?php endif;?>
        </div>
        <?php endforeach; ?>
    </section>
</body>
</html>
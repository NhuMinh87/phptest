<?php
$product = [
    "name" => "iPhone 17 Pro Max 2TB",
    "price" => 4999,
    "qty" => 10,
    "image" => "images/iphone17.png"
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
        <div class="container">
            <h1><?php echo $product ["name"];?></h1>
            <img src="images/iphone17.png" alt="<?php echo $product ["name"];?>" width="300">
            <p>$<?php echo $product ["price"];?></p>
            <?php if($product ["qty"] > 0) :?>
            <p class="text-success">Con hang!</p>
            <?php else:?>
            <p class="text-danger">Het hang!</p>
            <?php endif;?>
        </div>
    </section>
</body>
</html>

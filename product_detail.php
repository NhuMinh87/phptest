<?php
// Lấy id từ URL
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
if ($id <= 0) {
    die("Thiếu ID!");
}

// Kết nối DB
$host= "localhost";
$user= "root";
$password= "root";
$db= "T2507E";

$conn= new mysqli($host,$user,$password,$db);
if($conn->connect_error){
    die("Kết nối thất bại".$conn->connect_error);
}

// Truy vấn sản phẩm theo ID
$sql= "SELECT products.*, categories.name AS category_name 
       FROM products 
       LEFT JOIN categories ON products.category_id = categories.id
       WHERE products.id = $id";

$result= $conn->query($sql);

// Nếu không có sản phẩm
if($result->num_rows == 0){
    die("Không tìm thấy sản phẩm!");
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Detail</title>
    <?php include("html/style.php"); ?>
</head>

<body>
<section>
    <div class="container mt-4">
        <h1><?php echo $data["name"]; ?></h1>

        <img src="<?php echo $data["thumbnail"]; ?>" width="200">

        <p><b>Giá:</b> <?php echo $data["price"]; ?> </p>
        <p><b>Số lượng:</b> <?php echo $data["qty"]; ?> </p>
        <p><b>Mô tả:</b> <?php echo $data["description"]; ?> </p>
        <p><b>Danh mục:</b> <?php echo $data["category_name"]; ?> </p>

        <a href="/edit_product.php?id=<?php echo $data["id"]; ?>" class="btn btn-info">Edit</a>
        <a href="/delete_product.php?id=<?php echo $data["id"]; ?>" class="btn btn-danger"
        onclick="return confirm('Chắc chắn xóa?');">Delete</a>
    </div>
</section>
</body>
</html>

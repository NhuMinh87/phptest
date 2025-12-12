<?php
// Lấy id category từ URL
if(!isset($_GET["category_id"])){
    die("Thiếu ID category!");
}
$category_id = intval($_GET["category_id"]);


// Kết nối DB
$host= "localhost";
$user= "root";
$password= "root";
$db= "T2507E";

$conn= new mysqli($host,$user,$password,$db);
if($conn->connect_error){
    die("Kết nối thất bại: ".$conn->connect_error);
}

// Lấy danh sách product theo category_id
$sql = "SELECT products.*, categories.name AS category_name
        FROM products 
        LEFT JOIN categories ON products.category_id = categories.id
        WHERE category_id = $category_id";

$result = $conn->query($sql);

$data = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product by Category</title>
    <?php include("html/style.php");?>
</head>
<body>
<section>
    <div class="container-fluid">
        <div class="row">
            <?php include("html/aside.php"); ?>
            <main class="col">
                <h1>Products in category: 
                    <span class="text-primary">
                        <?php echo $data ? $data[0]["category_name"] : "Không có sản phẩm"; ?>
                    </span>
                </h1>

                <?php if(empty($data)): ?>
                    <p>Không tìm thấy sản phẩm nào trong danh mục này!</p>
                <?php else: ?>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Qty</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $item): ?>
                            <tr>
                                <td><?php echo $item["id"]; ?></td>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo $item["price"]; ?></td>
                                <td><img src="<?php echo $item["thumbnail"]; ?>" width="60"></td>
                                <td><?php echo $item["qty"]; ?></td>
                                <td><?php echo $item["description"]; ?></td>
                                <td>
                                    <a href="/product_detail.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-primary">Detail</a>
                                    <a href="/edit_product.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                    <a href="/delete_product.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </main>
        </div>
    </div>
</section>
</body>
</html>

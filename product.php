<?php
    //các thông số
    $host= "localhost";
    $user= "root";
    $password= "root";
    $db= "T2507E";
    //b1 : Kết nối db
    $conn= new mysqli($host,$user,$password,$db);
    if($conn->connect_error){
        die("Kết nối thất bại".$conn->connect_error);
    }
    //b2 : Truy vấn
    $sql= "SELECT products.*, categories.name as category_name 
            FROM products left join categories 
            on products.category_id = categories.id";
    $result= $conn->query($sql);
    //b3 : Xử lý kết quả
    $data = [];
    if($result->num_rows>0){
        while($row= $result->fetch_assoc()){
            $data[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <?php include("html/style.php");?>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("html/aside.php");?>
                <main class="col">
                    <h1>Product</h1>
                    <a href="/create_product.php"class="btn btn-outline-primary">Create a product</a>
                    <table class="table mt-2">
                        <thead>
                            <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Action</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category_id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $item):?>
                            <tr>
                                <th scope="row"><?php echo $item["id"]; ?></th>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo $item["price"]; ?></td>
                                <td><img src= <?php echo $item["thumbnail"];?> width="60"/></td>
                                <td><?php echo $item["qty"]; ?></td>
                                <td><?php echo $item["description"]; ?></td>
                                <td><?php echo $item["category_name"]; ?></td>
                                <td>
                                    <a href="/product_detail.php?id=<?php echo $item['id']; ?>" 
                                    class="btn btn-outline-primary">Detail</a>

                                    <a href="/edit_product.php?id=<?php echo $item['id']; ?>" 
                                    class="btn btn-outline-info">Edit</a>

                                    <a href="/delete_product.php?id=<?php echo $item['id']; ?>" 
                                    class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                        </table>
                         </main>
            </div>
        </div>
    </section>
</body>
</html>

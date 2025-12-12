<?php
    //lấy giá trị id (tham số trên url)
    $id = $_GET["id"];

    // lấy dữ liệu từ db theo id đã lấy ở trên, để cho vào form dưới
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
        $sql = "select * from products where id = $id ";
        $rs = $conn->query($sql);
        if($rs->num_rows == 0){
            // chuyeenr về trang 404
            die("404 not found!");
        } 
        $data = $rs->fetch_assoc();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
<?php include("html/style.php");?>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("html/aside.php");?>
                <main class="col">
                    <h1>Edit product</h1>
                    <form action="/update_product.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $data["id"];?>"/>
                        <div class="mb-3">
                            <label class="form-label">Product name</label>
                            <input type="text" name="name" value="<?php echo $data["name"];?>" class="form-control" placeholder="Product name...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" value="<?php echo $data["price"];?>" class="form-control" placeholder="price...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="text" name="thumbnail" value="<?php echo $data["thumbnail"];?>" class="form-control" placeholder="image...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Qty</label>
                            <input type="text" name="qty" value="<?php echo $data["qty"];?>" class="form-control" placeholder="qty...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" name="description" value="<?php echo $data["description"];?>" class="form-control" placeholder="description...">
                        </div>
                        <div class="mb-3">
                        <label class="form-label">Category ID</label>
                        <input type="text" name="category_id" value="<?php echo $data["category_id"];?>" class="form-control">
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </main>
            </div>
        </div>
    </section>
</body>
</html>
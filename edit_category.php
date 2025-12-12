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
        $sql = "select * from categories where id = $id ";
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
    <title>Edit category</title>
<?php include("html/style.php");?>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("html/aside.php");?>
                <main class="col">
                    <h1>Edit category</h1>
                    <form action="/update_category.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $data["id"];?>"/>
                        <div class="mb-3">
                            <label class="form-label">Category name</label>
                            <input type="text" name="name" value="<?php echo $data["name"];?>" class="form-control" placeholder="Category name..">
                                    </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" value="<?php echo $data["slug"];?>" class="form-control" placeholder="Category slug..">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </main>
            </div>
        </div>
    </section>
</body>
</html>
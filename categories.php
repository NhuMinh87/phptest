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
    $sql= "SELECT * FROM categories";
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
                    <h1>Category</h1>
                    <a href="/create_category.php"class="btn btn-outline-primary">Create a category</a>
                    <table class="table mt-2">
                        <thead>
                            <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $item):?>
                            <tr>
                                <th scope="row"><?php echo $item["id"]; ?></th>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo $item["slug"]; ?></td>
                                <td>
                                    <a href="/edit_category.php?id=<?php echo $item ["id"]; ?>" 
                                    class="btn btn-outline-info">Edit</a>
                                    <a onclick="return confirm('Chắc chắn xoá')" 
                                    href="/delete_category.php?id=<?php echo $item ["id"]; ?>" 
                                    class="btn btn-outline-danger">Delete</a>
                                     <a href="/list_product_by_category.php?id=<?php echo $item ["id"]; ?>" 
                                    class="btn btn-outline-primary">View products</a>
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


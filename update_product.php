<?php
// nhận data từ form
$id = $_POST["id"];
$name = $_POST["name"];
$price = $_POST["price"];
$thumbnail = $_POST["thumbnail"];
$qty = $_POST["qty"];
$description = $_POST["description"];
$category_id = $_POST["category_id"];

// tạo thành sql và lưu vào db
// các thông số
    $host= "localhost";
    $user= "root";
    $password= "root";
    $db= "T2507E";
    //b1 : Kết nối db
    $conn= new mysqli($host,$user,$password,$db);
    if($conn->connect_error){
        die("Kết nối thất bại".$conn->connect_error);
    }

$sql = "update products set name='$name', price='$price', thumbnail='$thumbnail', qty='$qty', description='$description',
category_id='$category_id' where id= $id"; 
$conn->query($sql);
//sau khi lưu vào db xong thì quay về trang danh sách
header("Location: /product.php");
?>      

<?php
// nhận data từ form
$id = $_POST["id"];
$name = $_POST["name"];
$slug = $_POST["slug"];

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

$sql = "update categories set name='$name', slug='$slug' where id= $id"; 
$conn->query($sql);
//sau khi lưu vào db xong thì quay về trang danh sách
header("Location: /categories.php");
?>      

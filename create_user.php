<?php 
// nhận data từ form
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
// tạo thành sql và lưu vào db
 // các thông số
    $host = "localhost";
    $user = "root";
    $pwd = "root";
    $db = "t2507e";
    // b1. kết nối db
    $conn = new mysqli($host,$user,$pwd,$db);
    if($conn->connect_error){
        die("Connect database fail!");
    }
    $password = password_hash($password,PASSWORD_BCRYPT);
    $sql = "insert into users(name,email,password) values('$name','$email','$password')";
    $conn->query($sql);
    // sau khi lưu vào db xong thì chuyển về trang danh sách
    header("Location: /login.php");
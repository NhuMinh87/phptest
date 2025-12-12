<?php 
session_start();
// nhận data từ form
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
 //1. dựa vào email tìm row có email vừa điền
$sql = "select * from users where email= '$email';";
$rs = $conn->query($sql);
if($rs->num_rows ==0){
    echo "Email or password is not correct!";
    die();
}
$user = $rs->fetch_assoc();// chỉ có 1 thôi
 // 2. nếu có email và row khớp nhau-> So sánh mật khẩu
$check_password = password_verify($password,$user["password"]);
if($check_password === false){
    echo "Email or password is not correct!";
    die();
}
 //3. Nếu mật khẩu phù hợp thì lưu user vào session
$_SESSION["user"] = $user;
echo "Login successfully";
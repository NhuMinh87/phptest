<?php
// nhận data từ form
$name = $_POST["name"];
$slug = $_POST["slug"];
$icon = $_POST["icon"];
// tạo thành sql và lưu vào db
// các thông số
    $host = "localhost";
    $user = "root";
    $password = "root";
    $db= "T2507E";
    //b1 : Kết nối db
    $conn= new mysqli($host,$user,$password,$db);
    if($conn->connect_error){
        die("Kết nối thất bại".$conn->connect_error);
    }
    // xử lý upload file
    $file = $_FILES["icon"];
    $accepted = true;

    // kiểm tra đảm bảo phải là loại ảnh cho phép
    if(getimagesize($file["tmp_name"])===false){
        // ko phải ảnh
        $accepted = false;
        echo "Vui long tai file anh";
    }

    // kiểm tra đuôi file
    $allowType = ["jpg", "jpeg", "png", "gif"];
    $exFile = pathinfo($file["name"], PATHINFO_EXTENSION);
    $exFile =strtolower($exFile); // chuyển thành chữ in thường

    if(!in_array($exFile,$allowType)){
        $accepted = false;
        echo "Vui lòng tải file ảnh có định dạng png jpg jpeg gif";
    }

    // giới hạn dung lượng 5MB  
    if($file["size"] > 5 * 1024 *1024){
        $accepted =false;
    }

    // tạo tên file là string ngẫu nhiên
    $fileName = bin2hex(random_bytes(16)).".".$exFile;

    if($accepted){
        // tạo thư mục lưu ảnh
        $year = date("Y");
        $month = date("m");
        $path = "uploads/$year/$month";
        if(!is_dir($path)){
            mkdir($path,777,true);
        }
        $targetFile = 'uploads/'.$fileName;
        move_uploaded_file($file["tmp_name"],$targetFile);
    }else{
        die("upload file không đúng yêu cầu");
    }
    // end upload

if($accepted){
    // tạo thư mục lưu ảnh
    $year = date("Y");
    $month = date("m");
    $path = "uploads/$year/$month";

    if(!is_dir($path)){
        mkdir($path, 0777, true);
    }

    // LƯU ĐÚNG ĐƯỜNG DẪN
    $targetFile = "$path/$fileName";
    move_uploaded_file($file["tmp_name"], $targetFile);

}else{
    die("upload file không đúng yêu cầu");
}


$sql = "INSERT INTO categories (name, slug, icon) VALUES ('$name', '$slug', '$icon')"; 
$conn->query($sql);
//sau khi lưu vào db xong thì quay về trang danh sách
header("Location: /categories.php");
?>     
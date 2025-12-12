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
        $sql = "delete FROM categories WHERE id= $id";
        $result= $conn->query($sql);
        header("Location: /categories.php");
?>
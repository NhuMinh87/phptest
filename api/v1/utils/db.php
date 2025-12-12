<?php
$conn = null;
function connect(){
    global $conn;
    if(!$conn){
        $host = "localhost";
        $user = "root";
        $pwd = "root";
        $db = "t2507e";
        // b1. kết nối db
        $conn = new mysqli($host,$user,$pwd,$db);
        if($conn->connect_error){
            die("Connect database fail!");
        }
    }
    return $conn;
}

function query($sql){ // select * from ...
    $conn = connect();
    $rs = $conn->query($sql);
    $data = [];
    while($row = $rs->fetch_assoc()){
        $data[] = $row;
    }
    return $data;
}

function queryUpdate($sql){
    $conn = connect();
    if$conn->query($sql) === TRUE{
        return $conn->insert_id; // trả về id của bản ghi mới chèn
}
    return 0;
}
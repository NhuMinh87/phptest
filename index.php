<?php 
session_start();
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    echo "<h1>Xin chào: ".$user["name"]."</h1>";
}
// code php here
echo "Hello, World!"; 
// variable - datatype
$x;
$x = 10; //number
$x = "hello";
$y = 20;
if ($y > 10) {
 //A
} elseif ($y > 5) {
 //B
} elseif ($y > 0) {
 //C
} else {
 //D
}

for ($i = 0; $i < 10; $i++) {
 //loop
}

$arr = [];
$arr = 1;
$arr = "hello";
$arr = true; 

$student = [];
$student['name'] = "John";
$student['age'] = 20;
$student['adress'] = "123 Main St";
echo $student['name']. "_". $student['age']. "_". $student['adress'];

$product = [
    "name" => "Iphone 17 promax 2TB",
    "price" => 4999,
    "qty" => 10     
];  
echo $product['name']. "_". $product['price']. "_". $product['qty'];

foreach($arr as $item) {
 echo $item; //arr[i]
}

foreach($product as $key => $item) {
 echo $key. "=". $item; //arr[i]
}

function total($a, $b) {
    echo $a + $b;
//  return $a + $b;
}

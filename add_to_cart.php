// add_to_cart.php
<?php


$id = $_GET['id'];
require 'db.php';
$sql = "select * from products where id=$id";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);



$user_id = $_SESSION['user_id'] ?? 1; 


$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];
$size = $_POST['size'];  


$sql_check = "SELECT * FROM cart WHERE product_id = $product_id AND user_id = $user_id";
$result_check = mysqli_query($connect, $sql_check);

if (mysqli_num_rows($result_check) > 0) {

    $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $product_id AND user_id = $user_id";
    mysqli_query($connect, $update_sql);
} else {

    $insert_sql = "INSERT INTO cart (user_id, product_id, quantity, size, product_name, product_price, product_image) 
                   VALUES ($user_id, $product_id, 1, '$size', '$product_name', $product_price, '$product_image')";
    mysqli_query($connect, $insert_sql);
}


header('Location: cart.php');
exit;

?>


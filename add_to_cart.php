// add_to_cart.php
<?php


$id = $_GET['id'];
require 'db.php';
$sql = "select * from products where id=$id";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);


// Kiểm tra người dùng đã đăng nhập chưa
$user_id = $_SESSION['user_id'] ?? 1; // Sử dụng user_id từ session (giả sử có giá trị mặc định là 1 nếu không đăng nhập)

// Lấy thông tin sản phẩm từ form
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];
$size = $_POST['size'];  // Kích cỡ sản phẩm

// Kiểm tra sản phẩm đã có trong giỏ hàng chưa
$sql_check = "SELECT * FROM cart WHERE product_id = $product_id AND user_id = $user_id";
$result_check = mysqli_query($connect, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // Nếu có rồi, tăng số lượng lên
    $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $product_id AND user_id = $user_id";
    mysqli_query($connect, $update_sql);
} else {
    // Nếu chưa có, thêm mới vào giỏ hàng
    $insert_sql = "INSERT INTO cart (user_id, product_id, quantity, size, product_name, product_price, product_image) 
                   VALUES ($user_id, $product_id, 1, '$size', '$product_name', $product_price, '$product_image')";
    mysqli_query($connect, $insert_sql);
}

// Chuyển hướng đến trang giỏ hàng
header('Location: cart.php');
exit;

?>


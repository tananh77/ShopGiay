<?php
$id = $_GET['id'];  // Lấy ID của sản phẩm cần xóa
require 'db.php';

// Lấy thông tin sản phẩm để lấy tên ảnh
$sql = "SELECT avatar FROM products WHERE id = $id";
$result = mysqli_query($connect, $sql);
$product = mysqli_fetch_array($result);

// Xóa ảnh nếu có
$image_path = 'images/' . $product['image'];
if (file_exists($avatar_path)) {
    unlink($avatar_path); // Xóa ảnh khỏi thư mục
}

// Xóa sản phẩm khỏi cơ sở dữ liệu
$sql = "DELETE FROM products WHERE id = $id";
if (mysqli_query($connect, $sql)) {
    echo "Sản phẩm đã được xóa!";
    header('Location: product_list.php');  // Điều hướng đến danh sách sản phẩm
} else {
    echo "Lỗi: " . mysqli_error($connect);
}
?>

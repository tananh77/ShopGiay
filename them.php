<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    
    // Xử lý upload ảnh
    $upload_path = 'images/' . $avatar;
    move_uploaded_file($avatar_tmp, $upload_path);

    // Lưu dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
    mysqli_query($connect, $sql);
    
    // Chuyển hướng về trang danh sách sản phẩm
    header('Location: product_list.php');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <h2>Thêm Sản Phẩm Mới</h2>
    <form action="them.php" method="POST" enctype="multipart/form-data">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Mô tả:</label>
        <textarea name="description" id="description" rows="4" required></textarea>

        <label for="price">Giá:</label>
        <input type="number" name="price" id="price" required>

        <label for="image">Ảnh sản phẩm:</label>
        <input type="file" name="image" id="image" accept="images/*" required>

        <button type="submit">Thêm sản phẩm</button>
    </form>
</body>
</html>

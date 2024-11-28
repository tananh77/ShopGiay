<?php
$id = $_GET['id']; // Lấy ID của sản phẩm
require 'db.php';

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($connect, $sql);
$product = mysqli_fetch_array($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $avatar = $_FILES['avatar']['name'];

    // Kiểm tra nếu có ảnh mới
    if ($image) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_path = 'images/' . $image;
        move_uploaded_file($image_tmp, $upload_path);
    } else {
        $avatar = $product['avatar']; // Giữ nguyên ảnh cũ
    }

    // Cập nhật sản phẩm trong cơ sở dữ liệu
    $sql = "UPDATE products SET name='$name', price='$price', description='$description', avatar='$avatar' WHERE id=$id";
    if (mysqli_query($connect, $sql)) {
        echo "Sản phẩm đã được cập nhật!";
        header("Location: product_list.php"); // Điều hướng đến danh sách sản phẩm
    } else {
        echo "Lỗi: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <h2>Sửa Sản Phẩm</h2>
    <form action="sua.php?id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>" required>

        <label for="description">Mô tả:</label>
        <textarea name="description" id="description" rows="4" required><?php echo $product['description']; ?></textarea>

        <label for="price">Giá:</label>
        <input type="number" name="price" id="price" value="<?php echo $product['price']; ?>" required>

        <label for="image">Ảnh sản phẩm (nếu muốn thay đổi):</label>
        <input type="file" name="image" id="image" accept="images/*">

        <button type="submit">Cập nhật sản phẩm</button>
    </form>
</body>
</html>

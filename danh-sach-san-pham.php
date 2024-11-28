<?php
require 'db.php';
$sql = "SELECT * FROM products";
$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <h2>Danh Sách Sản Phẩm</h2>
    <a href="them.php">Thêm sản phẩm mới</a>
    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</td>
                    <td><?php echo $product['description']; ?></td>
                    <td><img src="images/<?php echo $product['avatar']; ?>" width="100" alt="Product Image"></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>">Sửa</a> | 
                        <a href="delete_product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

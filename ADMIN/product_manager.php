<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            position: fixed;
        }
        .sidebar a {
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            color: #fff;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .sidebar sidebar-h3 a{
            font-size:200px ;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
   <!-- <a class="sidebar-h3" href="admin.php" class="text-center text-light py-3">Admin Panel</a> -->
    <h3 class="text-center text-light py-3">Admin Panel</h3>
    <a href="product_manager.php">Quản lý sản phẩm</a>
    <a href="manage_users.php">Quản lý tài khoản</a>
    <a href="manage_comments.php">Quản lý bình luận</a>
    <a href="manage_orders.php">Quản lý đơn hàng</a>
    <a href="settings.php">Cài đặt</a>
    <a href="logout.php">Đăng xuất</a>
</div>

<!-- Main Content -->

<div class="main-content">
    <a href="admin.php" class="btn btn-primary" role="button">ADMIN</a>
    <div class="container mt-4">
        <h1>Quản lý sản phẩm</h1>
        <a href="add_product.php" class="btn btn-success mb-3">Thêm sản phẩm</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $products->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= number_format($row['price'], 2) ?> VND</td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>
                        <?php if ($row['image']): ?>
                            <img src="uploads/<?= $row['image'] ?>" alt="Product Image" width="100">
                        <?php else: ?>
                            <span>Không có</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="manage_products.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost:3306', 'root', '', 'bangiay');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý xóa sản phẩm
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM sanpham WHERE id = $delete_id");
    header("Location: manage_products.php");
    exit();
}

// Lấy danh sách sản phẩm
$products = $conn->query("SELECT * FROM sanpham ORDER BY created_at DESC");
?>



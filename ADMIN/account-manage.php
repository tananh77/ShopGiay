<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost:3306', 'root', '', 'bangiay');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý xóa người dùng
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM nguoidung WHERE user_id = $delete_id");
    header("Location: account-manage.php");
    exit();
}

// Lấy danh sách người dùng
$users = $conn->query("SELECT * FROM nguoidung");
if (!$users) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
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
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3 class="text-center text-light py-3">Admin Panel</h3>
    <a href="product_manager.php">Quản lý sản phẩm</a>
    <a href="account-manage.php">Quản lý tài khoản</a>
    <a href="manage_comments.php">Quản lý bình luận</a>
    <a href="manage_orders.php">Quản lý đơn hàng</a>
    <a href="settings.php">Cài đặt</a>
    <a href="logout.php">Đăng xuất</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h1>Quản lý người dùng</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>SĐT</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($users && $users->num_rows > 0): ?>
            <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['user_id']) ?></td>
                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['numbers']) ?></td>
                    <td>
                        <a href="edit-user.php?id=<?= $row['user_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="account-manage.php?delete_id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Không có người dùng nào.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

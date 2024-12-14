<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <a href="#users">Quản lý tài khoản</a>
    <a href="#comments">Quản lý bình luận</a>
    <a href="#orders">Quản lý đơn hàng</a>
    <a href="#settings">Cài đặt</a>
    <a href="#logout">Đăng xuất</a>
</div>
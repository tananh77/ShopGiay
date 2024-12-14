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
    <a href="account-manage.php">Quản lý tài khoản</a>
    <a href="#comments">Quản lý bình luận</a>
    <a href="#orders">Quản lý đơn hàng</a>
    <a href="#settings">Cài đặt</a>
    <a href="#logout">Đăng xuất</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="container">
        <p>Chào mừng bạn đến với trang quản trị.</p>
        <hr>

        <!-- Quản lý sản phẩm -->
        <h2 id="products">Quản lý sản phẩm</h2>
        <p>Chức năng quản lý sản phẩm bao gồm thêm, sửa, xóa và xem danh sách sản phẩm.</p>
        <!-- <button class="btn_xemsp">Xem sản phẩm</button> -->
        <a href="product_manager.php" class="btn btn-primary" role="button">Xem sản phẩm</a>



        <hr>

        <!-- Quản lý tài khoản -->
        <h2 id="users">Quản lý tài khoản</h2>
        <p>Quản lý người dùng bao gồm xem, chỉnh sửa và xóa tài khoản.</p>
        <a href="account-manage.php" class="btn btn-primary" role="button">Xem danh sách</a>

        <hr>

        <!-- Quản lý bình luận -->
        <h2 id="comments">Quản lý bình luận và đánh giá</h2>
        <p>Kiểm duyệt các bình luận và đánh giá từ người dùng.</p>
        <button class="btn btn-primary">Kiểm duyệt</button>
        <hr>

        <!-- Quản lý đơn hàng -->
        <h2 id="orders">Quản lý đơn hàng</h2>
        <p>Theo dõi và xử lý các đơn đặt hàng từ khách hàng.</p>
        <button class="btn btn-primary">Xem đơn hàng</button>
        <hr>

        <!-- Cài đặt -->
        <h2 id="settings">Cài đặt</h2>
        <p>Thay đổi các tùy chỉnh hệ thống.</p>
        <button class="btn btn-primary">Cập nhật cài đặt</button>
        <hr>
    </div>
</div>

</body>
</html>


<?php

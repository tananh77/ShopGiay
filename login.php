<?php
session_start(); // Bắt đầu session để lưu trữ thông tin đăng nhập của người dùng

// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "bangiay"; // Tên cơ sở dữ liệu

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli('localhost:3306', 'root', '', 'bangiay');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error); // Thông báo lỗi nếu kết nối thất bại
}

// Xử lý đăng nhập khi biểu mẫu được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Kiểm tra xem yêu cầu là từ phương thức POST
    $email = $_POST['email']; // Lấy dữ liệu email từ biểu mẫu
    $password = $_POST['password']; // Lấy dữ liệu mật khẩu từ biểu mẫu

    // Chuẩn bị câu lệnh truy vấn để ngăn chặn SQL Injection
    $stmt = $conn->prepare("SELECT * FROM nguoidung WHERE email = ?"); // Chỉ tìm theo email
    
    // Kiểm tra xem câu lệnh chuẩn bị có thành công không
    if ($stmt === false) {
        die("Lỗi chuẩn bị truy vấn: " . $conn->error); // Thông báo lỗi nếu chuẩn bị câu lệnh thất bại
    }

    // Gán tham số và thực thi câu truy vấn
    $stmt->bind_param("s", $email); // Truyền email vào câu truy vấn
    $stmt->execute(); // Thực thi câu truy vấn
    $result = $stmt->get_result(); // Lấy kết quả truy vấn

    // Kiểm tra kết quả trả về
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Lấy thông tin người dùng từ cơ sở dữ liệu
        // Kiểm tra mật khẩu bằng phép so sánh trực tiếp
        if ($password == $row['password']) { // So sánh trực tiếp nếu mật khẩu không mã hóa
            $_SESSION['email'] = $email; // Lưu email vào session để giữ trạng thái đăng nhập
            header("Location: index.php"); // Chuyển hướng đến trang chủ sau khi đăng nhập thành công
        } else {
            header ("Location: index.php");;  // Chuyển hướng đến trang chủ sau khi đăng nhập thành công
        }
    } else {
        echo "<p style='color:red;'>Sai Tên Đăng Nhập Hoặc Mật Khẩu!</p>";  // Thông báo nếu mật khẩu hoặc gmail không đúng
    }

    // Đóng câu lệnh
    $stmt->close();
}

// Đóng kết nối
$conn->close();
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Shoe Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <img class="img" src="../img/logo.jpg" alt="" style="width: 80px;">
        <nav>
            <a href="demo.php">Trang chủ</a>
            <a href="#">Sản phẩm</a>
            <a href="#">Liên hệ</a>
        </nav>
        <div class="header-icons">
            <input type="text" placeholder="Tìm kiếm...">
            <button><i class="fa fa-search"></i></button>
            <i class="fa fa-user"></i>
            <i class="fa fa-heart"></i>
            <i class="fa fa-shopping-cart"></i>
        </div>
    </header>

    <!-- Login Form -->
    <div class="register-container">
        <form class="register-form" method="POST" action="">
            <h2>Đăng Nhập</h2>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng Nhập</button>
            <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <img src="/img/bando.jpg" alt="Map" class="map-image">
            <div class="contact-info">
                <p>Địa chỉ: 170 An Dương Vương/ Nguyễn Văn Cừ/Quy Nhơn/Bình Định</p>
                <p>Email: Familyshop@gmail.com.vn</p>
                <p>FaceBook: ShopFamily</p>
            </div>
        </div>
    </footer>
</body>
</html>

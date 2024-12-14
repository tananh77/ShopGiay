<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Đăng Ký</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <!-- PHP xử lý đăng ký -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kết nối cơ sở dữ liệu
        $conn = new mysqli('localhost:3306', 'root', '', 'bangiay');


        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Nhận dữ liệu từ form và xử lý
        $username = $conn->real_escape_string($_POST["username"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $numbers = $conn->real_escape_string($_POST["numbers"]);
        $password = $conn->real_escape_string($_POST["password"]);

        // Thêm dữ liệu vào bảng nguoidung
        $stmt=$conn->prepare("INSERT INTO nguoidung (user_name, email, numbers, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $numbers, $password);

        if ($stmt->execute() === TRUE) {
            header("Location: login.php");
        } else {
            echo "<p>Đăng ký thất bại: " . $conn->error . "</p>";
        }

        // Đóng kết nối
        $conn->close();
    }
    ?>

    <!-- Header -->
    <header>
        <img class="img" src="../img/logo2.png" alt="" style="width: 80px;>
        <nav>
            <a href="#">Trang chủ</a>
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

    <!-- Register Form -->
    <div class="register-container">
        <form class="register-form" method="POST" action="register.php">
            <h2>Đăng Ký</h2>
            <input type="text" name="username" placeholder="Tên Đăng nhập" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="numbers" placeholder="Số điện thoại" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng ký</button>
            <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
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

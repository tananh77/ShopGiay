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
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Mã hóa mật khẩu

        // Thêm dữ liệu vào bảng nguoidung
        $stmt=$conn->prepare("INSERT INTO nguoidung (user_name, email, numbers, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $numbers, $password);

        if ($stmt->execute() === TRUE) {
            echo "<p class='thongbao'>Đăng ký thành công!</p>";
        } else {
            echo "<p>Đăng ký thất bại: " . $conn->error . "</p>";
        }

        // Đóng kết nối
        $conn->close();
    }
    ?>

    <!-- Header -->
    <?php require('header.php') ?>

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
    <?php require('footer.php') ?>
</body>
</html>

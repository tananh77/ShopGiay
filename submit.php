<?php
session_start(); // Khởi tạo session để lấy thông tin người dùng

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bangiay";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['email'])) {
    $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Không xác định';
} else {
    $user_name = "khách"; // Nếu người dùng chưa đăng nhập
}

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $comment = $_POST['comment'];
    $product_id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$product_id) {
    die("Không tìm thấy ID sản phẩm.");
}

    // Kiểm tra nếu có bình luận
    if (!empty($comment)) {
        // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào cơ sở dữ liệu
        $stmt = $conn->prepare("INSERT INTO binhluan (user_name, comment, product_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $user_name, $comment, $product_id); // 's' cho chuỗi, 'i' cho số nguyên

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            echo "<p>Bình luận của bạn đã được gửi thành công!</p>";
        } else {
            echo "<p>Lỗi khi gửi bình luận: " . $stmt->error . "</p>";
        }

        // Đóng câu lệnh
        $stmt->close();
    } else {
        echo "<p>Bạn cần nhập bình luận trước khi gửi.</p>";
    }
}

// Đóng kết nối
$conn->close();
?>

<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost:3306', 'root', '', 'bangiay');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu URL chứa ID người dùng
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Lấy ID người dùng từ URL

    // Lấy thông tin người dùng từ cơ sở dữ liệu
    $result = $conn->query("SELECT * FROM nguoidung WHERE user_id = $user_id");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Lưu thông tin người dùng
    } else {
        die("Người dùng không tồn tại.");
    }
} else {
    die("ID người dùng không hợp lệ.");
}

// Xử lý khi gửi biểu mẫu chỉnh sửa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $numbers = $conn->real_escape_string($_POST['numbers']);

    // Truy vấn cập nhật thông tin người dùng
    $updateQuery = "UPDATE nguoidung SET user_name='$user_name', email='$email', numbers='$numbers' WHERE user_id=$user_id";
    if ($conn->query($updateQuery)) {
        header("Location: account-manage.php"); // Chuyển về trang quản lý tài khoản
        exit();
    } else {
        echo "Cập nhật thất bại: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin người dùng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Chỉnh sửa thông tin người dùng</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="user_name" class="form-label">Tên người dùng</label>
            <input type="text" name="user_name" id="user_name" class="form-control" value="<?= htmlspecialchars($user['user_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="numbers" class="form-label">Số điện thoại</label>
            <input type="text" name="numbers" id="numbers" class="form-control" value="<?= htmlspecialchars($user['numbers']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="account-manage.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>

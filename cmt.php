
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá sản phẩm</title>
    

    <style>
.review-container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.review-container h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.review-container label {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    display: block;
    margin-bottom: 10px;
}

.review-container input[type="text"],
.review-container textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.review-container textarea {
    height: 150px;
    resize: vertical;
}

.review-container button {
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.review-container button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

.review-container p {
    text-align: center;
    font-size: 14px;
    color: red;
    font-weight: bold;
}

/* Phần hiển thị bình luận */
.comments-section {
    width: 80%;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.comments-section h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.comment {
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f9f9f9;
}

.comment p {
    margin: 5px 0;
    font-size: 16px;
    color: #333;
}

.comment strong {

    text-decoration: underline;
    font-weight: bold;
    color: #007bff;
}

.comment em {
    font-size: 12px;
    color: #777;
    display: block;
    margin-top: 5px;
}

/* Thông báo khi không có bình luận */
.comments-section p {
    font-size: 16px;
    color: #666;
}

    </style>

    <?php
    

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bangiay";

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email']; // Lấy email từ session
        
        // Kiểm tra nếu 'user_name' tồn tại trong session, nếu không gán giá trị mặc định
        $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Không xác định'; 
        $isGuest = false; // Người dùng đã đăng nhập
        
        // Đặt tên để hiển thị là tên người dùng nếu đã đăng nhập
        $display_name = $user_name;
    } else {
        $email = ""; // Nếu chưa đăng nhập, email là rỗng
        $user_name = "khách"; // Nếu chưa đăng nhập, tên người dùng là "khách"
        $isGuest = true; // Người dùng là khách
        
        // Đặt tên hiển thị là "khách" nếu người dùng chưa đăng nhập
        $display_name = $user_name;
    }

    ?>
    
</head>
<body>
    <div class="review-container">
        <h1>Đánh giá sản phẩm</h1>
        <form method="post" action="submit.php?id=<?php echo $id; ?>">
    <label for="name">Tên:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($display_name); ?>" readonly>
    
    <label for="comment">Bình luận:</label>
    <textarea id="comment" name="comment" <?php echo $isGuest ? 'disabled' : ''; ?>></textarea>
    
    <!-- Nút gửi đánh giá bị vô hiệu hóa nếu là khách -->
    <button type="submit" <?php echo $isGuest ? 'disabled' : ''; ?>>Gửi đánh giá</button>
</form>


        <?php if ($isGuest): ?>
            <p style="color: red;">Bạn phải đăng nhập để gửi đánh giá.</p>
        <?php endif; ?>
    </div>
    
    <div class="comments-section">
    <h2>Bình luận về sản phẩm</h2>
    <?php
    // Lấy product_id từ URL
    $product_id = isset($_GET['id']) ? $_GET['id'] : null;
    
    // Truy vấn lấy bình luận của sản phẩm
    $sql = "SELECT user_name, comment FROM binhluan WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    
    // Liên kết tham số
    $stmt->bind_param("i", $product_id);
    
    // Thực thi câu lệnh
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Hiển thị bình luận
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='comment'>";
            echo "<p><strong>" . htmlspecialchars($row['user_name']) . "</strong></p>";
            echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Chưa có bình luận nào cho sản phẩm này.</p>";
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
    ?>
</div>
</div>
</body>
</html>

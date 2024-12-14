// cart.php
<?php

$id = $_GET['id'];
require 'db.php';
$sql = "select * from products where id=$id";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);


// Kiểm tra xem người dùng đã đăng nhập chưa
$user_id = $_SESSION['user_id'] ?? 1; // Dùng mặc định 1 nếu chưa đăng nhập

// Lấy thông tin giỏ hàng của người dùng
$sql = "SELECT * FROM cart WHERE user_id = $user_id";
$result = mysqli_query($connect, $sql);

$total = 0;  // Biến tính tổng
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
</head>
<body>
    <h1>Giỏ hàng của bạn</h1>

    <table border="1">
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Kích cỡ</th>
            <th>Tổng</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            $total += $row['product_price'] * $row['quantity'];
            echo '<tr>
                    <td><img src="images/' . $row['product_image'] . '" alt="' . $row['product_name'] . '" width="50" /> ' . $row['product_name'] . '</td>
                    <td>' . number_format($row['product_price'], 0, ',', '.') . ' VND</td>
                    <td>' . $row['quantity'] . '</td>
                    <td>' . $row['size'] . '</td>
                    <td>' . number_format($row['product_price'] * $row['quantity'], 0, ',', '.') . ' VND</td>
                </tr>';
        }
        ?>
    </table>

    <h3>Tổng cộng: <?php echo number_format($total, 0, ',', '.') . ' VND'; ?></h3>
    <a href="checkout.php">Thanh toán</a>
</body>
</html>

?>

<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bangiay";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn danh sách sản phẩm từ bảng `sanpham`
$sql = "SELECT product_id, product_name, price, image FROM sanpham";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm giày</title>
    <style>
        .product {
            display: inline-block;
            width: 200px;
            margin: 20px;
            text-align: center;
        }
        .product img {
            width: 100%;
            height: auto;
        }
        .product-name {
            font-size: 18px;
            margin: 10px 0;
        }
        .product-price {
            color: red;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h1>Danh sách sản phẩm</h1>

<div class="product-list">
    <?php
    if ($result->num_rows > 0) {
        // Hiển thị sản phẩm
        while($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='" . $row['image'] . "' alt='" . $row['product_name'] . "'>";
            echo "<div class='product-name'>" . $row['product_name'] . "</div>";
            echo "<div class='product-price'>" . number_format($row['price'], 0, ',', '.') . " VND</div>";
            echo "</div>";
        }
    } else {
        echo "Không có sản phẩm nào.";
    }
    ?>
</div>

</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>

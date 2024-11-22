<?php
// Database connection details
$servername = "localhost";
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "bangiay"; // Database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products
$sql = "SELECT * FROM sanpham"; // Replace 'sanpham' with the actual table name if different
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Family Shoe Store</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <!-- Header -->
    <header>
        <img class="img" src="../img/logo.jpg" alt="" style="width: 80px;">
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

    <!-- Banner -->
    <section id="home" class="banner">
        <img src="hình ảnh/IE0586.webp" alt="Giảm giá đặc biệt mùa đông">
        <div class="banner-text">
            <h2>Giảm giá mùa đông - Lên đến 50%</h2>
            <p>Chỉ trong thời gian ngắn, hãy mua sắm ngay hôm nay!</p>
        </div>
    </section>

    <!-- Sản phẩm nổi bật -->
    <section id="products" class="featured-products">
        <div class="container">
            <h2>Sản phẩm nổi bật</h2>
            <div class="product-list">
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="sanpham">';
                        echo '<img src="img/' . htmlspecialchars($row['hinhanh']) . '" alt="' . htmlspecialchars($row['ten']) . '">';
                        echo '<h3>' . htmlspecialchars($row['ten']) . '</h3>';
                        echo '<p>' . number_format($row['gia'], 0, ',', '.') . ' VND</p>';
                        echo '<a href="#" class="add-to-cart">Xem chi tiết</a>';
                        echo '</div>';
                    }
                } else {
                    echo "No products found";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Ưu đãi đặc biệt -->
    <section id="special-offers" class="special-offers">
        <div class="container">
            <h2>Ưu đãi đặc biệt</h2>
            <p>Đăng ký nhận bản tin và nhận ngay mã giảm giá 10% cho đơn hàng đầu tiên của bạn!</p>
            <button>Đăng ký ngay</button>
        </div>
    </section>

    <!-- Liên hệ -->
    <section id="contact" class="contact-info">
        <div class="container">
            <h2>Liên hệ với chúng tôi</h2>
            <p>Email: shopgiay@gmail.com</p>
            <p>Điện thoại: +84 123 456 789</p>
            <p>Địa chỉ: 123 Hoàng Văn Thụ, Thành Phố Quy Nhơn, Tỉnh Bình Định</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <img src="/img/bando.jpg" alt="Map" class="map-image">
            <div class="contact-info">
                <p>Địa chỉ: 170 An Dương Vương, Nguyễn Văn Cừ, Quy Nhơn, Bình Định</p>
                <p>Email: Familyshop@gmail.com.vn</p>
                <p>FaceBook: ShopFamily</p>
            </div>
        </div>
    </footer>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>

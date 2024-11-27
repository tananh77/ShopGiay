<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Trang chủ cửa hàng bán giày</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require('header.php') ?>
    <!-- Banner -->
    <section id="home" class="banner">
        <img src="images/loginshoes.jpg" alt="Giảm giá đặc biệt mùa đông">
        <div class="banner-text">
            <h2>Giảm giá mùa đông - Lên đến 50%</h2>
            <p>Chỉ trong thời gian ngắn, hãy mua sắm ngay hôm nay!</p>
            </style>
        </div>
    </section>

    <!-- Giới thiệu -->
    <section class="intro">
        <div class="container">
            <h2>Giới thiệu</h2>
            <p>Chào mừng bạn đến với cửa hàng giày của chúng tôi! Tại đây, bạn sẽ tìm thấy những đôi giày thời trang, chất lượng cao từ các thương hiệu nổi tiếng. Hãy khám phá các sản phẩm và tận hưởng trải nghiệm mua sắm thú vị cùng chúng tôi.</p>
        </div>
    </section>
    <section class="brand-section">
        <h2>Thương hiệu</h2>
        <div class="brand-slider">
            <div class="brand-item"><img src="images/tải xuống.png" alt="Adidas"></div>
            <div class="brand-item"><img src="images/media.png" alt="Nike"></div>
            
        </div>
    </section>

    <!-- Sản phẩm nổi bật -->
    <section id="products" class="featured-products">
        <div class="container">
            <h2>Sản phẩm nổi bật</h2>
            <div class="product-list">
                <?php
                $url = 'http://localhost/shopgiay/html/images';
                require 'db.php';
                $sql = "select * from products limit 4";
                $result = mysqli_query($connect, $sql);

                foreach ($result as $product) {
                    echo '<div class="product-item">';
                    echo '<img src="' . htmlspecialchars($url . '/' . $product['avatar']) . '" alt="' . htmlspecialchars($product['name']) . '">';
                    echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                    echo '<p>' . number_format($product['price'], 0, ',', '.') . ' VND</p>';
                    echo '<a href="chi-tiet-san-pham.php?id=' . $product['id'] . '" class="add-to-cart">Xem chi tiết</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
    <section class="brand-section">
  
    <!-- Ưu đãi đặc biệt -->
    <section id="special-offers" class="special-offers">
        <div class="container">
            <h2>Ưu đãi đặc biệt</h2>
            <p>Đăng ký nhận bản tin và nhận ngay mã giảm giá 10% cho đơn hàng đầu tiên của bạn!</p>
            <button>Đăng ký ngay</button>
        </div>
    </section>

  <?php require('footer.php') ?>

</body>
</html>

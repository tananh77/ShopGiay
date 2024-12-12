<?php session_start(); ?>
<?php
require 'db.php';

$id = $_GET['id'];
$sql = "select * from products where id=$id";
$result = mysqli_query($conn, $sql);
$each = mysqli_fetch_array($result);

$sql = "select url from product_images where product_id=$id limit 4";
$images = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            gap: 30px;
        }

        .product-image-container {
            flex: 1;
        }

        .product-image img.main-image {
            width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .thumbnail-images {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .thumbnail-images img {
             max-width: 60px; 
             max-height: 60px;
            object-fit: contain; 
            border: 1px solid #ddd;
             border-radius: 5px;
             cursor: pointer;
                transition: transform 0.2s, border-color 0.2s; 
}

        .thumbnail-images img:hover {
            border-color: #ff5733;
            transform: scale(1.1);
}


        .product-info {
            flex: 2;
        }

        .product-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 22px;
            color: #ff5733;
            margin-bottom: 10px;
        }

        .product-description h3 {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .product-description p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }

        .size-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 10px 0;
        }

        .size-options button {
            padding: 10px 20px;
            border: 1px solid #ddd;
            background-color: #f3f3f3;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .size-options button:hover {
            background-color: #ff5733;
            color: #fff;
        }

        .actions button {
            margin-right: 10px;
            padding: 12px 20px;
            background-color: #ff5733;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .actions button:hover {
            background-color: #e04d2a;
        }

        .suggested-products {
            margin: 40px auto;
            max-width: 1200px;
        }

        .suggested-products h3 {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .suggested-products-list {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .suggested-product {
            flex: 1;
            text-align: center;
            background-color: white;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: transform 0.2s ease;
        }

        .suggested-product:hover {
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .suggested-product img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .suggested-product-title {
            font-size: 16px;
            margin: 10px 0;
            color: #333;
        }

        .suggested-product-price {
            font-size: 18px;
            font-weight: bold;
            color: #ff5733;
        }
    </style>
</head>

<body>
    <?php require('header.php'); ?>

    <div class="container">
        <!-- Phần hình ảnh -->
        <div class="product-image-container">
            <img class="main-image" src="images/<?php echo $each['avatar']; ?>" alt="Main Product Image">
            <div class="thumbnail-images">
                <?php $i=1;  foreach ($images as $img) { ?>
                    <img src="images/<?php echo $img['url']; ?>" alt="Thumbnail <?php $i++?>">
                <?php } ?>
            </div>
        </div>

        <!-- Phần thông tin -->
        <div class="product-info">
            <h1 class="product-title"><?php echo $each['name']; ?></h1>
            <p class="product-price"><?php echo number_format($each['price'], 0, ',', '.'); ?> VND</p>
            <div class="product-description">
                <h3>Mô tả sản phẩm:</h3>
                <p><?php echo $each['description']; ?></p>
            </div>

            <div class="size-options">
                <h3>Chọn kích thước:</h3>
                <div class="size-buttons">
                    <button class="size-button" data-size="36">36</button>
                    <button class="size-button" data-size="37">37</button>
                    <button class="size-button" data-size="38">38</button>
                    <button class="size-button" data-size="39">39</button>
                    <button class="size-button" data-size="40">40</button>
                    <button class="size-button" data-size="41">41</button>
                    <button class="size-button" data-size="42">42</button>
                    <button class="size-button" data-size="43">43</button>
                </div>
            </div>

            <div class="actions">
                <button>Thêm Vào Giỏ Hàng</button>
                <button>Mua Ngay</button>
            </div>
        </div>
    </div>

    <!-- Sản phẩm gợi ý -->
    <section id="products" class="featured-products">
        <div class="container">
            <h2>Sản phẩm gợi ý</h2>
            <div class="product-list">
                <?php
                $url = 'http://localhost/shopgiay/html/images';
                require 'db.php';
                $sql = "select * from products limit 3";
                $result = mysqli_query($conn, $sql);

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

    <?php require ('cmt.php'); ?>

    <?php require('footer.php'); ?>
    <script>
  
    // Lấy các phần tử cần thiết
    const thumbnails = document.querySelectorAll('.thumbnail-images img');
    const mainImage = document.querySelector('.main-image');

    // Thêm sự kiện click cho mỗi thumbnail
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            // Lấy đường dẫn ảnh từ thumbnail
            const newSrc = thumbnail.src;

            // Cập nhật ảnh lớn với đường dẫn mới
            mainImage.src = newSrc;

            // Highlight ảnh thumbnail đã chọn
            thumbnails.forEach(thumb => thumb.style.border = '1px solid #ddd');
            thumbnail.style.border = '2px solid #ff5733';
        });
    });


</script>
    
</body>



</html>

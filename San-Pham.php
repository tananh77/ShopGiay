<?php $url = 'http://localhost/shopgiay/html/images'; ?>

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
   <style>
        .featured-products {
            padding: 40px 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .featured-products h2 {
            font-size: 2em;
            color: #333;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            justify-content: center;
        }

        .product-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: left;
            position: relative;
        }

        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .product-item img {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
            aspect-ratio: 1;
        }

        .product-item h3 {
            font-size: 1rem;
            margin: 10px 0;
            color: #333;
            font-weight: 500;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .product-item .product-price {
            color: #ff4d4d;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-item .btn-detail {
            padding: 8px 15px;
            background-color: #0073e6;
            color: white;
            font-size: 0.8rem;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .product-item .btn-detail:hover {
            background-color: #005bb5;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #0073e6;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .pagination a:hover {
            background-color: #005bb5;
        }

        .sort-options {
            margin-bottom: 20px;
        }

        .sort-options a {
            margin: 0 10px;
            text-decoration: none;
            color: #0073e6;
        }

        .sort-options a:hover {
            text-decoration: underline;
        }
    </style>

    <section id="products" class="featured-products">
        <div class="container">
            <h2>Sản phẩm</h2>

            <!-- Tùy chọn sắp xếp -->
            <div class="sort-options">
                <span>Sắp xếp theo:</span>
                <a href="?sort=name&order=asc">Tên tăng dần</a> |
                <a href="?sort=name&order=desc">Tên giảm dần</a> |
                <a href="?sort=price&order=asc">Giá thấp đến cao</a> |
                <a href="?sort=price&order=desc">Giá cao đến thấp</a>
            </div>

            <div class="product-list">
                <?php
                require 'db.php';

                // Lấy thông tin sắp xếp từ URL
                $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
                $sort_order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';
                $allowed_columns = ['id', 'name', 'price'];
                if (!in_array($sort_column, $allowed_columns)) {
                    $sort_column = 'id';
                }

                // Phân trang
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $limit = 10; // Số sản phẩm mỗi trang
                $offset = ($page - 1) * $limit;

                // Truy vấn dữ liệu sản phẩm
                $sql = "SELECT * FROM products ORDER BY $sort_column $sort_order LIMIT $limit OFFSET $offset";
                $result = mysqli_query($connect, $sql);

                // Hiển thị sản phẩm
                foreach ($result as $product) {
                    echo '<div class="product-item">';
                    echo '<img src="' . htmlspecialchars($url . '/' . $product['avatar']) . '" alt="' . htmlspecialchars($product['name']) . '">';
                    echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                    echo '<p class="product-price">' . number_format($product['price'], 0, ',', '.') . ' VND</p>';
                    echo '<a href="chi-tiet-san-pham.php?id=' . $product['id'] . '" class="btn-detail">Xem chi tiết</a>';
                    echo '</div>';
                }

                // Đếm tổng số sản phẩm
                $count_result = mysqli_query($connect, "SELECT COUNT(*) AS total FROM products");
                $total_rows = mysqli_fetch_assoc($count_result)['total'];
                $total_pages = ceil($total_rows / $limit);
                ?>
            </div>

            <!-- Liên kết phân trang -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&sort=<?php echo $sort_column; ?>&order=<?php echo $sort_order; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </section>
    
    <?php require('footer.php') ?>
</body>
</html>

    <script>
        // Lấy tất cả các ảnh sản phẩm
        const thumbnails = document.querySelectorAll('.product-thumbnail');
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', () => {
                modalImage.src = thumbnail.src; // Đặt ảnh vào modal
                modal.classList.add('active'); // Hiển thị modal
            });
        });

        // Đóng modal khi click ra ngoài
        modal.addEventListener('click', () => {
            modal.classList.remove('active');
        });
    </script>
</body>
</html>

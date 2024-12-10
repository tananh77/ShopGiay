<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Cart.css">
    <title>Family Shoe Store - Giỏ Hàng</title>
</head>
<body>
    <!-- Header -->
     
    <?php require('header.php') ?>

    <div class="breadcrumb">
        <a href="#">Trang chủ</a> <span>&gt;</span> Giỏ hàng
    </div>

    <div class="container">
        <h2>GIỎ HÀNG CỦA TÔI</h2>

        <div class="steps">
            <div class="active">Giỏ hàng của tôi <span>🛒</span></div>
            <div>Thanh toán <span>💰</span></div>
            <div>Hoàn tất <span>✔️</span></div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Áo thun nữ Belike</td>
                    <td><img src="https://via.placeholder.com/50" alt="Product"></td>
                    <td>119,000đ</td>
                    <td>2</td>
                    <td>238,000đ</td>
                    <td><button class="delete">Xóa</button></td>
                </tr>
            </tbody>
        </table>

        <div class="summary">
            <p>Tổng thanh toán: <strong>238,000đ</strong></p>
        </div>

        <div class="buttons">
            <button class="continue">TIẾP TỤC MUA HÀNG</button>
            <button class="checkout">TIẾN HÀNH THANH TOÁN</button>
        </div>
    </div>
    <!-- Footer -->
    <?php require('footer.php') ?>
</body>
</html>

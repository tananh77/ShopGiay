<?php
session_start();

// Nếu giỏ hàng chưa tồn tại, khởi tạo giỏ hàng trống
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Hàm tính tổng tiền đơn hàng
function calculateTotal($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shopping-cart.css">
    <title>Thanh toán</title>
</head>
<body>
    <!-- Header -->
    <?php require('header.php') ?>

    <div class="container">
        <div class="breadcrumb">
            <a href="#">Trang chủ</a> <span>&gt;</span> Thanh toán
        </div>

        <h1>THANH TOÁN</h1>

        <div class="step">
            <div class="active">Giỏ hàng của tôi</div>
            <div class="active">Thanh toán</div>
            <div>Hoàn tất</div>
        </div>

        <!-- Địa chỉ thanh toán -->
        <div class="section">
            <h3>1. ĐỊA CHỈ THANH TOÁN VÀ GIAO HÀNG</h3>
            <label for="name">Họ & Tên</label>
            <input type="text" id="name" placeholder="Nhập họ và tên">

            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" placeholder="Nhập số điện thoại">

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Nhập email">

            <label for="address">Địa chỉ</label>
            <input type="text" id="address" placeholder="Nhập địa chỉ">
        </div>

        <!-- Phương thức thanh toán -->
        <div class="section">
            <h3>2. THANH TOÁN VÀ VẬN CHUYỂN</h3>
            <label for="shipping">Vận chuyển</label>
            <select id="shipping">
                <option>Chọn phương thức vận chuyển</option>
            </select>

            <h4>Thanh toán</h4>
            <label><input type="radio" name="payment" value="atm"> Thanh toán online qua cổng OnePay bằng thẻ ATM nội địa</label>
            <label><input type="radio" name="payment" value="cod"> Thanh toán khi giao hàng (COD)</label>
            <label><input type="radio" name="payment" value="bank"> Chuyển khoản qua ngân hàng</label>
            <label><input type="radio" name="payment" value="visa"> Thanh toán online qua cổng OnePay bằng thẻ Visa/Master/JCB</label>
        </div>

        <!-- Thông tin đơn hàng -->
        <div class="section order-summary">
            <h3>3. THÔNG TIN ĐƠN HÀNG</h3>
            <table>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="50"></td>
                            <td><?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2">Thành tiền</td>
                        <td><?= number_format(calculateTotal($_SESSION['cart']), 0, ',', '.') ?> đ</td>
                    </tr>
                    <tr>
                        <td colspan="2">Phí vận chuyển</td>
                        <td>0 đ</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="total">THANH TOÁN</td>
                        <td class="total"><?= number_format(calculateTotal($_SESSION['cart']), 0, ',', '.') ?> đ</td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Giỏ hàng của bạn đang trống.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <!-- Đặt hàng -->
        <button class="btn">ĐẶT HÀNG</button>
    </div>
    <!-- Footer -->
    <?php require('footer.php') ?>
</body>
</html>

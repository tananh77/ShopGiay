<?php
// Khởi tạo session để lưu giỏ hàng
session_start();

// Nếu giỏ hàng chưa tồn tại, khởi tạo giỏ hàng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý khi người dùng thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['quantity'];

    // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity'] += $product_quantity; // Cộng dồn số lượng
            $found = true;
            break;
        }
    }
    if (!$found) {
        // Thêm sản phẩm mới vào giỏ hàng
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => $product_quantity
        ];
    }

    // Chuyển hướng về trang giỏ hàng sau khi thêm sản phẩm
    header('Location: cart.php');
    exit;
}

// Xử lý khi người dùng xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Loại bỏ sản phẩm khỏi giỏ hàng
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Cập nhật lại giỏ hàng (chỉ số array)
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: cart.php');
    exit;
}
?>
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
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="Product" width="50"></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</td>
                            <td>
                                <a href="cart.php?action=remove&id=<?= $item['id'] ?>" class="delete">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Giỏ hàng của bạn đang trống.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="summary">
            <p>Tổng thanh toán: <strong>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
                echo number_format($total, 0, ',', '.') . 'đ';
                ?>
            </strong></p>
        </div>

        <div class="buttons">
            <a href="index.php" class="continue">TIẾP TỤC MUA HÀNG</a>
            <form action="shopping-cart.php" method="post" style="display: inline;">
        <button type="submit" class="checkout">TIẾN HÀNH THANH TOÁN</button>
    </form>
        </div>
    </div>
    <!-- Footer -->
    <?php require('footer.php') ?>

</body>
</html>

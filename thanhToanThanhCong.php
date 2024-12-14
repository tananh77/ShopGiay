<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoàn Tất Đơn Hàng</title>
</head>
<body>
    <!-- Header -->
    <?php require('header.php') ?>
    <!-- Thông báo thành công -->
    <div>
        <p><strong>✓ Success!</strong> Đơn hàng của bạn đã được mua thành công</p>
    </div>

    <!-- Thông tin đơn hàng -->
    <div>
        <h3>Mã đơn hàng của bạn: <span>#100002528</span></h3>
        <p><strong>Ngày đặt:</strong> 14/12/2024</p>
        <p><strong>Phương thức thanh toán:</strong> Thanh toán khi giao hàng (COD)</p>
    </div>

    <!-- Bảng thông tin sản phẩm -->
    <table border="1" width="100%" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>STT</th>
                <th>SẢN PHẨM</th>
                <th>ĐƠN GIÁ</th>
                <th>SỐ LƯỢNG</th>
                <th>THÀNH TIỀN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Áo sơ mi nữ VNXK</td>
                <td>280.000</td>
                <td>1</td>
                <td>280.000đ</td>
            </tr>
        </tbody>
    </table>

    <!-- Tổng thanh toán -->
    <div>
        <p><strong>TỔNG THANH TOÁN:</strong> <span>280.000 đ</span></p>
    </div>

    <!-- Các nút chức năng -->
    <div>
        <button>TIẾP TỤC MUA HÀNG</button>
        <button>ĐƠN HÀNG CỦA TÔI</button>
    </div>
     <!-- Footer -->
     <?php require('footer.php') ?>
</body>
</html>

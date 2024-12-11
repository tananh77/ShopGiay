<?php
// Bao gồm file kết nối cơ sở dữ liệu
include('connect.php');  // Đảm bảo đường dẫn đúng với vị trí file connect.php



// Lấy thông tin sản phẩm và khách hàng từ cơ sở dữ liệu
$query_products = "SELECT * FROM sanpham";
$result_products = mysqli_query($conn, $query_products);

$query_users = "SELECT * FROM nguoidung";
$result_users = mysqli_query($conn, $query_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Thêm Bootstrap cho giao diện đẹp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Dashboard</h2>

        <!-- Bảng thông tin sản phẩm -->
        <h3 class="mt-4">Sản phẩm</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                 
                    <th>Brand</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result_products)): ?>
                    <tr>
                      
                        <td><?php echo $row['brand_id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo number_format($row['price'], 0, ',', '.'); ?> VND</td>
                        <td><img src="../img/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>" width="50"></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Bảng thông tin khách hàng -->
        <h3 class="mt-4">Khách hàng</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
             
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result_users)): ?>
                    <tr>
                        
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['numbers']; ?></td>
                      
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Thêm script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

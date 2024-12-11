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
    <title>Admin Dhboard</title>
    <!-- Thêm Bootstrap cho giao diện đẹp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<style>   ul.navbar {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #333;
        }

        ul.navbar li {
            display: inline-block;
        }

        ul.navbar li a {
            display: block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            background-color: #333;
        }

        ul.navbar li a:hover {
            background-color: #4CAF50; /* Màu nền khi hover */
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }</style>
<ul class="navbar">
        <li><a href="#">Quản lý khách hàng</a></li>
        <li><a href="admin.php">Quản lý sản phẩm </a></li>
    </ul>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Dashboard</h2>

        <!-- Bảng thông tin sản phẩm -->
        

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

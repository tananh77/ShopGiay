<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bangiay";

// Kết nối database
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có yêu cầu thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        // Thêm sản phẩm
        $name = $conn->real_escape_string($_POST['product_name']);
        $price = $conn->real_escape_string($_POST['product_price']);
        $size = $conn->real_escape_string($_POST['product_size']);
        $description = $conn->real_escape_string($_POST['product_description']);
        $avatar = $_FILES['product_image']['name'];
        $target = "img/" . basename($avatar);

        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target)) {
            $sql = "INSERT INTO sanpham (name, price, size, description, avatar) 
                    VALUES ('$name', '$price', '$size', '$description', '$avatar')";
            if ($conn->query($sql) === TRUE) {
                echo "Thêm sản phẩm thành công.";
            } else {
                echo "Lỗi: " . $conn->error;
            }
        } else {
            echo "Không thể tải lên hình ảnh.";
        }
    } elseif (isset($_POST['edit_product'])) {
        // Sửa sản phẩm
        $id = $conn->real_escape_string($_POST['product_id']);
        $name = $conn->real_escape_string($_POST['product_name']);
        $price = $conn->real_escape_string($_POST['product_price']);
        $size = $conn->real_escape_string($_POST['product_size']);
        $description = $conn->real_escape_string($_POST['product_description']);
        $avatar = $_FILES['product_image']['name'];

        $avatar_query = "";
        if (!empty($avatar)) {
            $target = "img/" . basename($avatar);
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target)) {
                $avatar_query = ", avatar='$avatar'";
            }
        }

        $sql = "UPDATE sanpham 
                SET name='$name', price='$price', size='$size', description='$description' $avatar_query 
                WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Sửa sản phẩm thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}

// Xóa sản phẩm
if (isset($_GET['delete'])) {
    $id = $conn->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM sanpham WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Xóa sản phẩm thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        img {
            max-width: 50px;
        }
        .actions a {
            margin: 0 5px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Quản lý Sản phẩm</h1>

    <!-- Form thêm hoặc sửa sản phẩm -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" id="product_id">

        <label for="product_name">Tên Sản phẩm:</label>
        <input type="text" name="product_name" id="product_name" required>

        <label for="product_price">Giá:</label>
        <input type="number" name="product_price" id="product_price" required>

        <label for="product_size">Kích Cỡ:</label>
        <input type="text" name="product_size" id="product_size" required>

        <label for="product_description">Mô tả:</label>
        <textarea name="product_description" id="product_description" required></textarea>

        <label for="product_image">Hình ảnh:</label>
        <input type="file" name="product_image" id="product_image">

        <button type="submit" name="add_product">Thêm Sản phẩm</button>
        <button type="submit" name="edit_product">Sửa Sản phẩm</button>
    </form>

    <!-- Bảng danh sách sản phẩm -->
    <h2>Danh sách Sản phẩm</h2>
    <table>
        <thead>
            <tr>
                <th>Tên Sản phẩm</th>
                <th>Giá</th>
                <th>Kích Cỡ</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Kết nối lại cơ sở dữ liệu
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Truy vấn dữ liệu sản phẩm
            $sql = "SELECT * FROM sanpham";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['size']}</td>
                        <td>{$row['description']}</td>
                        <td><img src='img/{$row['avatar']}' alt='Hình ảnh'></td>
                        <td class='actions'>
                            <a href='?edit={$row['id']}'>Sửa</a> | 
                            <a href='?delete={$row['id']}'>Xóa</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có sản phẩm nào.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>



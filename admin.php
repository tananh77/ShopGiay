<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "bangiay");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra nếu có yêu cầu thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        // Thêm sản phẩm
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $size = $_POST['product_size'];
        $description = $_POST['product_description'];
        $image = $_FILES['product_image']['name'];
        $target = "images/" . basename($image);

        move_uploaded_file($_FILES['product_image']['tmp_name'], $target);

        $sql = "INSERT INTO products (name, price, size, description, image) VALUES ('$name', '$price', '$size', '$description', '$image')";
        $conn->query($sql);
    } elseif (isset($_POST['edit_product'])) {
        // Sửa sản phẩm
        $id = $_POST['product_id'];
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $size = $_POST['product_size'];
        $description = $_POST['product_description'];
        $image = $_FILES['product_image']['name'];

        if ($image) {
            $target = "images/" . basename($image);
            move_uploaded_file($_FILES['product_image']['tmp_name'], $target);
            $image_query = "image='$image',";
        } else {
            $image_query = "";
        }

        $sql = "UPDATE products SET name='$name', price='$price', size='$size', description='$description', $image_query WHERE id='$id'";
        $conn->query($sql);
    }
}

// Xóa sản phẩm
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id=$id";
    $conn->query($sql);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
<style>  
 ul.navbar {
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
        <li><a href="admin_dashboard.php">Quản lý khách hàng</a></li>
        <li><a href="#">Quản lý sản phẩm</a></li>
    </ul>

    <!-- Form thêm và sửa sản phẩm -->
    <form action="admin.php" method="post" enctype="multipart/form-data" class="product-form">
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

    <!-- Danh sách sản phẩm -->
    <h2>Danh sách Sản phẩm</h2>
    <table border="1">
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
            // Lấy danh sách sản phẩm từ cơ sở dữ liệu
            $conn = new mysqli("localhost", "root", "", "bangiay");
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['size']}</td>
                        <td>{$row['description']}</td>
                        <td><img src='images/{$row['image']}' width='50'></td>
                        <td>
                            <a href='admin.php?edit={$row['id']}'>Sửa</a> | 
                            <a href='admin.php?delete={$row['id']}'>Xóa</a>
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

    <script>
        // Nếu có thao tác sửa, hiển thị thông tin sản phẩm lên form
        <?php if (isset($_GET['edit'])): ?>
            let editProductId = <?php echo $_GET['edit']; ?>;
            fetchProductData(editProductId);

            function fetchProductData(id) {
                fetch('get_product.php?id=' + id)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('product_id').value = data.id;
                        document.getElementById('product_name').value = data.name;
                        document.getElementById('product_price').value = data.price;
                        document.getElementById('product_size').value = data.size;
                        document.getElementById('product_description').value = data.description;
                    });
            }
        <?php endif; ?>
    </script>

</body>
</html>



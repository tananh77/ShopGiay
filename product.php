<?php

$id = $_GET['id'];
require 'db.php';
$sql = "select * from products where id=$id";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);

?><!-- Phần thông tin sản phẩm -->
<div class="actions">
    <form action="add_to_cart.php" method="POST">
        <!-- Thêm thông tin sản phẩm và kích cỡ vào form -->
        <input type="hidden" name="product_id" value="<?php echo $each['id']; ?>" />
        <input type="hidden" name="product_name" value="<?php echo $each['name']; ?>" />
        <input type="hidden" name="product_price" value="<?php echo $each['price']; ?>" />
        <input type="hidden" name="product_image" value="<?php echo $each['image']; ?>" />

        <input type="hidden" name="size" id="selected-size" value="" />  <!-- Kích cỡ được chọn -->
        
        <button type="submit">Thêm Vào Giỏ Hàng</button>
    </form>
    <button>Mua Ngay</button>
</div>

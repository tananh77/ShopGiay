<?php

$connect = mysqli_connect('localhost','root','','shoestore');
    mysqli_set_charset($connect,'utf8');

// Kiểm tra kết nối
if (!$connect) {
    die("Kết nối thất bại: " . mysqli_connect_error());
} else {
}
?>
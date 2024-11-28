<?php
$conn = new mysqli("localhost", "root", "", "bangiay");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

echo json_encode($product);

$conn->close();
?>

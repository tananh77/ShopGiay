<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Xử lý lưu thông tin hoặc gửi email
    // Ví dụ gửi email:
    $to = 'admin@yourstore.com';
    $subject = "Tin nhắn từ $name";
    $body = "Họ và tên: $name\nEmail: $email\nNội dung: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm!";
    } else {
        echo "Có lỗi xảy ra, vui lòng thử lại.";
    }
}
?>

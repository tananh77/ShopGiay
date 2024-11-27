<?php $url = 'http://localhost/shopgiay/html/images'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Trang chủ cửa hàng bán giày</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require('header.php') ?>
    <style>


/* Phần liên hệ */
.contact-section {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin: 10px 0; /* Khoảng cách trên và dưới nhỏ hơn */
    padding: 20px;
    background-color: #f9f9f9; /* Màu nền nhẹ */
    border: 1px solid #ddd; /* Viền nhẹ */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); /* Đổ bóng nhẹ */
    font-family: Arial, sans-serif;
}

.contact-info {
    flex: 1; /* Chiếm 50% chiều rộng */
    min-width: 250px; /* Đảm bảo không bị quá hẹp */
}

.contact-info h2 {
    margin-bottom: 15px;
    color: #0077ff; /* Màu xanh nổi bật */
    font-size: 20px; /* Font chữ vừa */
    text-align: center;
}

.contact-info p {
    font-size: 14px; /* Font chữ nhỏ hơn */
    line-height: 1.5;
    color: #00EE00;
    display: flex;
    align-items: center;
    gap: 10px;
}

.contact-info i {
    color: #0077ff; /* Màu icon đồng bộ */
    font-size: 16px; /* Icon nhỏ hơn */
}

.contact-info img {
    width: 100%; /* Chiếm toàn bộ chiều rộng */
    height: auto;
    border-radius: 10px; /* Bo góc hình ảnh */
    margin-bottom: 15px; /* Khoảng cách dưới hình ảnh */
}

.banner-text {
    text-align: left;
    margin-top: 10px;
}

/* Phần gửi tin nhắn */
.contact-form {
    flex: 1.5; /* Cân đối với phần thông tin liên hệ */
    min-width: 400px; /* Chiều rộng tối thiểu nhỏ hơn */
    padding: 10px;
    background-color: #ffffff; /* Màu nền nhẹ */
    border: 1px solid #ddd; /* Viền mỏng hơn */
    border-radius: 10px; /* Bo góc nhẹ */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); /* Đổ bóng nhẹ */
}

.contact-form h2 {
    margin-bottom: 20px; /* Khoảng cách gọn */
    color: #333; /* Màu chữ tối giản */
    font-size: 18px; /* Font chữ nhỏ gọn */
    font-weight: bold;
    text-align: center; /* Canh giữa */
}

.contact-form form {
    display: flex;
    flex-direction: column;
    gap: 10px; /* Giảm khoảng cách giữa các trường */
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 8px; /* Giảm padding */
    border: 1px solid #ccc; /* Viền nhẹ nhàng */
    border-radius: 5px;
    font-size: 14px; /* Font chữ nhỏ hơn */
    color: #555;
    background-color: #f9f9f9; /* Nền sáng hơn */
    transition: border-color 0.3s;
}

.contact-form input:focus,
.contact-form textarea:focus {
    border-color: #0077ff; /* Viền nổi bật khi focus */
    outline: none;
}

.contact-form button {
    padding: 10px; /* Nhỏ gọn */
    background-color: #0077ff; /* Màu xanh sáng */
    color: white;
    font-size: 14px; /* Font chữ nhỏ hơn */
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.contact-form button:hover {
    background-color: #005bb5;
    transform: scale(1.03); /* Hiệu ứng phóng to nhẹ khi hover */
}

/* Phần Google Maps */
.map-section iframe {
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Căn chỉnh khoảng cách */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Hình ảnh banner */
.banner img {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.banner-text h2 {
    margin-top: 20px;
    font-size: 26px;
    color: #0077ff; /* Chữ sáng màu hơn trong banner */
    text-align: center;
    text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8);
}

</style>
   <!-- Trang liên hệ -->


            <!-- Biểu mẫu liên hệ -->
            <div class="contact-form">
                
                <h2>Gửi tin nhắn cho chúng tôi</h2>
                <form action="submit_contact.php" method="post">
                    <input type="text" name="name" placeholder="Họ và Tên" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <textarea name="message" placeholder="Nội dung tin nhắn" rows="5" required></textarea>
                    <button type="submit">Gửi</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Google Maps -->
    <section class="map-section">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.730148327548!2d109.19984541420618!3d10.9418494922034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31762945b7a3d3ff%3A0x888df2d81d8d8e62!2zMTcwIEFuIMSQxrDhu51uZyBWxaluZywgUXXhu7kgTmjhuq9uLCBCw6xuaCDEkMO0bmgsIFZpZXRuYW0!5e0!3m2!1svi!2s!4v1681791326237!5m2!1svi!2s"
            width="100%" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"></iframe>
    </section>

    <?php require 'footer.php'; ?>
</body>
</html>



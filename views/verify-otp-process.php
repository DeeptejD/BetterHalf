<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OTP Verification</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@10..48,400;10..48,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/verified-otp.css">
</head>
<body>
    <div class="verification-container">
        <?php
        session_start();
        @include 'config.php';

        if (isset($_POST['otp'])) {
            $enteredOTP = mysqli_real_escape_string($conn, $_POST['otp']);
            $email = $_SESSION['email'];

            $select = "SELECT * FROM `otp_data` WHERE user_email = '$email' AND otp_code = '$enteredOTP' AND otp_expiry > NOW()";
            $result = mysqli_query($conn, $select);

            if (!$result) {
                echo '<div class="verification-icon failure">:(</div>';
                echo '<div class="verification-message failure">Database query error: ' . mysqli_error($conn) . ' Redirecting...</div>';
                echo '<script>
                    setTimeout(function() {
                    window.location.href = "verify-otp.php";
                    }, 3000);
                </script>';
            } elseif (mysqli_num_rows($result) > 0) {
                echo '<div class="verification-icon success">&#10004;</div>';
                echo '<div class="verification-message success">OTP verified successfully!</div>';
            } else {
                echo '<div class="verification-icon failure">:(</div>';
                echo '<div class="verification-message failure">Invalid OTP. Redirecting....</div>';
                echo '<script>
                    setTimeout(function() {
                    window.location.href = "verify-otp.php";
                    }, 3000);
                </script>';
            }
        }
        ?>
    </div>
    <video id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
                <source src="../assets/GradientBg.mp4" type="video/mp4">
                </video>
</body>
</html>

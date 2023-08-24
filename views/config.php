<?php
    $username = "root";
    $password = "";
    $db_name = "loginpage";

    $conn = mysqli_connect('localhost', $username, $password, $db_name);

// Create a new table for OTP data
$createOtpTableQuery = "
    CREATE TABLE IF NOT EXISTS `otp_data` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `user_email` VARCHAR(255) NOT NULL,
        `otp_code` INT NOT NULL,
        `otp_expiry` DATETIME NOT NULL
    );
";
mysqli_query($conn, $createOtpTableQuery);
?>
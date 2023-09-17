<?php
$username = "root";
$password = "";
$db_name = "loginpage";

$conn = mysqli_connect('localhost', $username, $password, $db_name);

$createOtpTableQuery = "
        CREATE TABLE IF NOT EXISTS `otp_data` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_email` VARCHAR(255) NOT NULL,
            `otp_code` INT NOT NULL,
            `otp_expiry` DATETIME NOT NULL
        );
    ";
mysqli_query($conn, $createOtpTableQuery);

$createtokenTableQuery = "
        CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
            `user_email` VARCHAR(255) NOT NULL PRIMARY KEY,
            `token` VARCHAR(255) NOT NULL,
            `otp_expiry` DATETIME NOT NULL
        );
    ";
mysqli_query($conn, $createtokenTableQuery);
?>
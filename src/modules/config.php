<?php
$username = "root";
$password = "";
$db_name = "loginpage";

$conn = mysqli_connect('localhost', $username, $password, $db_name);

// this creates the otp table
$createOtpTableQuery = "
        CREATE TABLE IF NOT EXISTS `otp_data` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_email` VARCHAR(255) NOT NULL,
            `otp_code` INT NOT NULL,
            `otp_expiry` DATETIME NOT NULL
        );
    ";
mysqli_query($conn, $createOtpTableQuery);

// this creates the password reset token table
$createtokenTableQuery = "
        CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
            `user_email` VARCHAR(255) NOT NULL PRIMARY KEY,
            `token` VARCHAR(255) NOT NULL,
            `otp_expiry` DATETIME NOT NULL
        );
    ";
mysqli_query($conn, $createtokenTableQuery);

// create calendar table if does not exist
$createCalendarTableQuery = "
        CREATE TABLE IF NOT EXISTS `calendar` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_email VARCHAR(255) NOT NULL,
            event_title VARCHAR(255) NOT NULL,
            start_date DATETIME NOT NULL,
            end_date DATETIME NOT NULL,
            event_description TEXT,
            event_link VARCHAR(255)
        );
    ";
mysqli_query($conn, $createCalendarTableQuery);

?>
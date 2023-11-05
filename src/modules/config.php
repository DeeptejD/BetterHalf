<?php
$username = "root";
$password = "";
$db_name = "loginpage";

$conn = mysqli_connect('localhost', $username, $password, $db_name);




$createregisterTableQuery = "
        CREATE TABLE IF NOT EXISTS `register` (
            `user_id` int(10) NOT NULL,
            `user_name` varchar(50) DEFAULT NULL,
            `user_email` varchar(50) NOT NULL,
            `user_password` varchar(256) DEFAULT NULL,
            `status` varchar(255) DEFAULT 'Online'
        );
    ";
mysqli_query($conn, $createregisterTableQuery);
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
            event_link VARCHAR(255),
            allDay BOOLEAN NOT NULL,
            color VARCHAR(255)
        );
    ";
mysqli_query($conn, $createCalendarTableQuery);

$createMessagesTableQuery = "
        CREATE TABLE IF NOT EXISTS `MESSAGES` (msg_id  INT(11) PRIMARY KEY AUTO_INCREMENT, incoming_msg_id VARCHAR(255), outgoing_msg_id VARCHAR(255), msg VARCHAR(255));
    ";
mysqli_query($conn, $createMessagesTableQuery);


$createDetailsTableQuery = "
        CREATE TABLE IF NOT EXISTS `details` (user_id  INT(11), DOB date, m_status varchar(50), gender varchar(50), religion varchar(50), caste varchar(50), age int(11), imgurl text, bio text, user_email VARCHAR(255));
    ";
mysqli_query($conn, $createDetailsTableQuery);

$createUsersTableQuery = "
        CREATE TABLE IF NOT EXISTS `users` (user_id  INT(11) PRIMARY KEY AUTO_INCREMENT, user_name VARCHAR(255), user_email VARCHAR(255), status VARCHAR(255));
    ";
mysqli_query($conn, $createUsersTableQuery);

$createGIS = "
CREATE TABLE IF NOT EXISTS `GIS` (
    latitude FLOAT DEFAULT NULL,
    longitude FLOAT DEFAULT NULL,
    user_email VARCHAR(255) PRIMARY KEY
);
";
mysqli_query($conn, $createGIS);

$interest = "CREATE TABLE IF NOT EXISTS `interest_requests` (
    request_id INT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    status ENUM('pending', 'accepted') DEFAULT 'pending'
);";
mysqli_query($conn, $interest);

$createkundaliTableQuery = "CREATE TABLE IF NOT EXISTS `kundali` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255) NOT NULL,
    `dob` DATE NOT NULL,
    `birth_time` TIME NOT NULL,
    `latitude` FLOAT DEFAULT NULL,
    `longitude` FLOAT DEFAULT NULL
);
";

mysqli_query($conn, $createkundaliTableQuery);

?>
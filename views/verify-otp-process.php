<?php
session_start();
@include 'config.php';

if (isset($_POST['otp'])) {
    $enteredOTP = mysqli_real_escape_string($conn, $_POST['otp']);
    $email = $_SESSION['email'];

    $select = "SELECT * FROM `otp_data` WHERE user_email = '$email' AND otp_code = '$enteredOTP' AND otp_expiry > NOW()";
    $result = mysqli_query($conn, $select);

    if (!$result) {
        echo "Database query error: " . mysqli_error($conn);
    } elseif (mysqli_num_rows($result) > 0) {
        echo "OTP verified successfully!";
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>

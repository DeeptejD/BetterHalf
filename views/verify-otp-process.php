<?php
session_start();
@include 'config.php';

if (isset($_POST['otp'])) {
    $enteredOTP = mysqli_real_escape_string($conn, $_POST['otp']);
    $email = $_SESSION['email'];

    $select = "SELECT * FROM `register` WHERE user_email = '$email' AND otp_code = '$enteredOTP' AND otp_expiry > NOW()";

    // $fetched_otp = "SELECT otp_code FROM `register` WHERE user_email = '$email' AND otp_code = '$enteredOTP' AND otp_expiry > NOW()";

    //echo "Entered OTP: $enteredOTP<br>";
    //echo "Stored Email: $email<br>";
    $result = mysqli_query($conn, $select);

    // $fotp = mysqli_query($conn, $fetched_otp);

    //    $row = mysqli_fetch_assoc($result);
//    $storedOTP = $row['otp_code'];

    // echo "Stored OTP: $storedOTP<br>";

    //if (mysqli_num_rows($result) > 0)
       // echo 'yes';
    //else
        //echo 'no';

    if (!$result) {
        echo "Database query error: " . mysqli_error($conn);
    } elseif (mysqli_num_rows($result) > 0) {
        echo "OTP verified successfully!";
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>

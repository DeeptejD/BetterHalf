<?php
session_start();
@include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    $select = " SELECT * FROM `register` WHERE user_email = '$email' && user_password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'User already exists!';

    } else {
        if (($name == "") || ($email == "") || ($pass != $cpass)) {
            $error[] = 'Registration Failed. Please recheck your entered details.';
        } else {
            $otp = mt_rand(100000, 999999); // 6-digit OTP
            date_default_timezone_set('Asia/Kolkata');
            $otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP expiry time (10 minutes from now)

            // Sending OTP via Email
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // smtp server
            $mail->SMTPAuth = true;
            $mail->Username = ''; //  ENTER EMAIL FROM WHICH TO SEND OTP HERE  
            $mail->Password = ''; // app password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('', ''); // ENTER EMAIL FROM WHICH TO SEND OTP HERE AND NAME (EMAIL LEFT, NAME RIGHT)
            $mail->addAddress($email, $name); // Use the user's email and name
            $mail->Subject = 'OTP Verification';
            $mail->Body = 'Your OTP is: ' . $otp;

            if (!$mail->send()) {
                echo 'OTP could not be sent. Please try again later.';
            } else {
                echo 'OTP sent successfully! Please check your email.';
            }

            $insert = "INSERT INTO `register` (user_name, user_email, user_password, otp_code, otp_expiry) VALUES ('$name', '$email', '$pass', '$otp', '$otp_expiry')";
            mysqli_query($conn, $insert);

            $_SESSION['email'] = $email; // Store the email in the session
            header('location:verify-otp.php');


            // header('location:login.php');
        }
    }

}
?>

<!DOCTYPE html>

<html>
    <head>
        <?php include './partials/head-content.php'; ?>
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
            <nav class="link">
                    <a href="login.php">Sign In</a>
            </nav>
            <video id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
                <source src="../assets/GradientBg.mp4" type="video/mp4">
                </video>

                

                <div class="form">
                    <h1 class="deez">Create an account</h1>
                    <form action="" method="POST">
                            <?php
                            if (isset($error)) {
                                foreach ($error as $error) {
                                    echo '<span color="white" class="error-msg">' . $error . '</span>';
                                }
                                ;
                            }
                            ;

                            ?>
                        <div class="nameinput">
                            Name
                            <br>
                            <input id="name" type="text" placeholder="Enter Your Name" name="username">
                        </div>
                        <div class="nameinput">
                            Email Address
                        <br>
                        <input id="email" type="email" placeholder="Enter You Email Id" name="email">
                        </div>
                        <div class="nameinput">
                            Password
                        <br>
                        <input id="pass" type="password" placeholder="Enter You Password" name="password">
                        </div>
                        <div class="nameinput">
                            Confirm Password
                        <br>
                        <input id="cnfrm-pass" type="password" placeholder="Enter Your Password" name="cpassword">
                        </div>
                        <input id="sbmitbtn" type="submit" value="Submit" name="submit">
                    </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script>
                    $("#sbmitbtn").on("click",function(){
        // var deez = $("#pass").value;
        var deez = document.getElementById("pass").value;
        var deeze = document.getElementById("email").value;
        var deezn = document.getElementById("name").value;
        var cnfpswd = document.getElementById("cnfrm-pass").value;
        

        if((deezn.length == 0)) {
            alert("Enter A Name");
            document.getElementById("pass").value = "";
            document.getElementById("cnfrm-pass").value = "";
        }
        if((deeze.length == 0)) {
            alert("Enter Valid Email Please");
            document.getElementById("pass").value = "";
            document.getElementById("cnfrm-pass").value = "";
        }
        if ((deez !== cnfpswd)) {
            alert("The Passwords entered differ!");
            document.getElementById("pass").value = "";
            document.getElementById("cnfrm-pass").value = "";
        }
        if((deez.length < 8)) {
            alert("Password must exceed 8 characters");
            document.getElementById("pass").value = "";
            document.getElementById("cnfrm-pass").value = "";
        }
    })
            </script>
    </body>
</html>
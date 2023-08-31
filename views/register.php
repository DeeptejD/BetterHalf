<?php
session_start();
@include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require './phpMailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $enteredPassword = $_POST['password'];
    $hashedPassword = password_hash($enteredPassword, PASSWORD_DEFAULT);
    $cpass = $_POST['cpassword'];
    $cHashedPassword = password_hash($cpass, PASSWORD_DEFAULT);

    $select = " SELECT * FROM `register` WHERE user_email = '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'User already exists!';
    } else {
        if (($name == "") || ($email == "") || !password_verify($cpass, $cHashedPassword)) {
            $error[] = 'Registration Failed. Please recheck your entered details.';
        } else {
            // OTP PART STARTS HERE
            $otp = mt_rand(100000, 999999); // 6-digit OTP
            date_default_timezone_set('Asia/Kolkata');
            $otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.gmail.com';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = 'matrimonydbms@gmail.com';
            $phpmailer->Password = 'jotbnkrvqpkugzcv';
            // $phpmailer->SMTPSecure = 'tls';
            $phpmailer->SMTPSecure = 'ssl';
            // $phpmailer->Port = 587;
            $phpmailer->Port = 465;
            $phpmailer->setFrom('matrimonydbms@gmail.com', 'Matrimony Project'); // (EMAIL, NAME)
            $phpmailer->addAddress($email, $name);
            $phpmailer->Subject = 'Here\'s your OTP!';
            $phpmailer->isHTML(true);

            // fetchin the template
            $otpEmailTemplate = file_get_contents('./otp/otp-mail-template.php');
            $otpEmailTemplate = str_replace('{{name}}', $name, $otpEmailTemplate);
            $otpEmailTemplate = str_replace('{{otp}}', $otp, $otpEmailTemplate);

            $phpmailer->Body = $otpEmailTemplate;

            if (!$phpmailer->send()) {
                echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
            } else {
                echo 'OTP sent successfully! Please check your inbox.';
                
                $insertOtpQuery = "INSERT INTO `otp_data` (user_email, otp_code, otp_expiry) VALUES ('$email', '$otp', '$otp_expiry')";
                mysqli_query($conn, $insertOtpQuery);

                $_SESSION['name'] = $name;
                $_SESSION['hashedPassword'] = $hashedPassword;
                $_SESSION['email'] = $email;
                header('location:verify-otp.php');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include './partials/head-content.php'; ?>
    
    <!-- for the google OAuth -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body class="flex-col justify-center items-center">
    <nav class="link">
        <a href="login.php">Sign In</a>
    </nav>
    <!-- <video id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
                <source src="../assets/GradientBg.mp4" type="video/mp4">
                </video> -->
    <div class="z-0 p-2 h-screen w-screen bg-repeat-x bg-contain bg-center flex justify-center items-center "
        style="background-image: url(bg.jpg);">
        <div class="rounded-2xl w-54 h-6/7 bg-white p-2 mr-4 text-black flex     justify-center items-center shadow-2xl">
            <form class="flex-col" action="register.php" method="POST">
                <h1 class="ml-10 mb-10 font-bold text-4xl">Create an account</h1>
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
                        <input class=" p-2 border-2 rounded-xl text-black  border-black" id="name" type="text" placeholder="Enter Your Name" name="username">
                    </div>
                    <div class="mb-5">
                        Email Address
                        <br>
                        <input class=" p-2 border-2 rounded-xl text-black  border-black" id="email" type="email" placeholder="Enter You Email Id" name="email">
                    </div>
                    <div class="mb-8">
                        Password
                        <br>
                        <input class=" p-2 border-2 rounded-xl text-black  border-black" id="pass" type="password" placeholder="Enter You Password" name="password">
                    </div>
                    <div class="mb-8">
                        Confirm Password
                        <br>
                        <input class=" p-2 border-2 rounded-xl text-black  border-black" id="cnfrm-pass" type="password" placeholder="Enter Your Password" name="cpassword">
                    </div>
                    <input class="mb-5 p-3 w-52 bg-black rounded-xl text-white hover:border-2 hover:border-black hover:bg-white hover:text-black" id="sbmitbtn" type="submit" value="Submit" name="submit">
                    <p style="text-align: center;">OR</p>
                    <div class="g-signin2" data-onsuccess="onGoogleSignIn" style="text-align: center;">Sign in with Google</div>
        
            </form>
        </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $("#sbmitbtn").on("click", function() {
                // var deez = $("#pass").value;
                var deez = document.getElementById("pass").value;
                var deeze = document.getElementById("email").value;
                var deezn = document.getElementById("name").value;
                var cnfpswd = document.getElementById("cnfrm-pass").value;


                if ((deezn.length == 0)) {
                    alert("Enter A Name");
                    document.getElementById("pass").value = "";
                    document.getElementById("cnfrm-pass").value = "";
                }
                if ((deeze.length == 0)) {
                    alert("Enter Valid Email Please");
                    document.getElementById("pass").value = "";
                    document.getElementById("cnfrm-pass").value = "";
                }
                if ((deez !== cnfpswd)) {
                    alert("The Passwords entered differ!");
                    document.getElementById("pass").value = "";
                    document.getElementById("cnfrm-pass").value = "";
                }
                if ((deez.length < 8)) {
                    alert("Password must exceed 8 characters");
                    document.getElementById("pass").value = "";
                    document.getElementById("cnfrm-pass").value = "";
                }
            })
        </script>
</body>

</html>
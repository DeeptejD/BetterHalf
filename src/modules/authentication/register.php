<?php
session_start();
@include '../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require './phpMailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

function isStrongPassword($password)
{
    // Minimum length of 8 characters
    if (strlen($password) < 8) {
        return false;
    }

    // Should contain at least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // Should contain at least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    // Should contain at least one digit
    if (!preg_match('/\d/', $password)) {
        return false;
    }

    // Should contain at least one special character
    if (!preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/', $password)) {
        return false;
    }

    // If all criteria are met, return true
    return true;
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $enteredPassword = $_POST['password'];

    if (isStrongPassword($enteredPassword)) {
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
                $phpmailer->setFrom('matrimonydbms@gmail.com', 'BetterHalf'); // (EMAIL, NAME)
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
    } else {
        $error[] = 'Please select a strong password!\n(strong password should have atleast 1 symbol, 1 number, 1 uppercase, 1 lowercase characters';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../partials/head-content.php'; ?>
    <title>Register</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="../../images/OG-images/favicon.ico" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-cover bg-center md:overflow-hidden h-full md:h-screen w-screen flex flex-col md:px-5" style="background-image: url('../../images/dashboard/background.jpg');">
        <div class="m-4 mb-0">
            <nav class="w-full h-fit rounded-full p-2 bg-gray-100 flex flex-row justify-between items-center bg-opacity-25 shadow-2xl" style="backdrop-filter: blur(8px);">
                <!-- <img src="../../images/OG-images/logo.png" class="h-full w-38 pl-8"> -->
                <a href="../../../index.html">
                    <img src="../../images/OG-images/horizontalnoBG.png" class=" w-36">
                </a>

                <div class=""><a href="login.php" class="m-1 text-semibold text-white flex justify-center items-center font-semibold mr-6 rounded-xl hover:shadow-2xl">Log
                        In</a></div>
            </nav>
        </div>
        <div class="flex-grow bg-white m-4 rounded-xl rounded-t-xl flex flex-col md:flex-row bg-opacity-25 shadow-xl" style="backdrop-filter: blur(8px);">
            <div class="bg-gray-900 rounded-t-xl md:rounded-l-xl w-full md:w-1/3 h-full overflow-hidden">
                <img src="../../images/login/hero-gif.gif" alt="" class="hidden md:block object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
                <img src="../../images/login/hero-mobile.gif" alt="" class="md:hidden block object-cover rounded-t-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
            </div>
            <div class="flex-grow rounded-r-xl md:ml-5 p-5 flex flex-col justify-center items-center">
                <form action="register.php" method="POST" class="w-full py-3 px-2">
                    <h1 class="text-gray-100  text-2xl md:text-3xl font-bold pb-1 mb-2">
                        Make the first move!</h1>
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<span color="white" class="error-msg">' . $error . '</span>';
                        };
                    };

                    ?>
                    <div class="pt-2">
                        <label for="name" class="text-white text-lg font-semibold shadow-2xl pl-2">Name</label>
                        <input type="text" placeholder="Enter your full name" name="username" id="name" class="w-full rounded-2xl shadow-2xl bg-white opacity-50 p-5  focus:outline-none">
                    </div>
                    <div class="pt-2">
                        <label for="email" class="text-white text-lg font-semibold shadow-2xl pl-2">Email</label>
                        <input type="emai" placeholder="johndoe@example.com" name="email" id="email" class="w-full rounded-2xl shadow-2xl bg-white opacity-50 p-5  focus:outline-none">
                    </div>
                    <div class="pt-2">
                        <label for="password" class="text-white text-lg font-semibold shadow-2xl pl-2">Password</label>
                        <input type="password" name="password" id="pass" placeholder="Min 8 characters" class="w-full rounded-2xl shadow-2xl bg-white opacity-50 p-5  focus:outline-none">
                    </div>
                    <div class="pt-2">
                        <label for="cpassword" class="text-white text-lg font-semibold shadow-2xl pl-2">Confirm
                            Password</label>
                        <input type="password" placeholder="* * * * * * * *" name="cpassword" id="cnfrm-pass" class="w-full rounded-2xl shadow-2xl bg-white opacity-50 p-5  focus:outline-none">
                    </div>
                    <div class="flex flex-row justify-end pt-11">
                        <input type="submit" name="submit" id="submit" class="md:w-1/5 w-full shadow-2xl text-center p-5 h-full rounded-xl bg-lime-100 hover:bg-lime-100 active:bg-[#ec679e]   active:shadow-inner font-semibold transition transform duration-500 hover:scale-90 active:scale-80 focus:outline-none" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("submit").addEventListener("click", function() {
            document.getElementById("name").style.border = "none";
            document.getElementById("email").style.border = "none";
            document.getElementById("pass").style.border = "none";
            document.getElementById("cnfrm-pass").style.border = "none";

            var deezn = document.getElementById("name").value;
            var deeze = document.getElementById("email").value;
            var deez = document.getElementById("pass").value;
            var cnfpswd = document.getElementById("cnfrm-pass").value;

            var isValid = true;

            if (deezn.length === 0) {
                isValid = false;
                document.getElementById("name").style.border = "2px solid red";
            }

            if (deeze.length === 0 || !deeze.includes("@") || !deeze.includes(".")) {
                isValid = false;
                document.getElementById("email").style.border = "2px solid red";
            }

            if (deez.length < 8) {
                isValid = false;
                document.getElementById("pass").style.border = "2px solid red";
            }

            if (deez !== cnfpswd) {
                isValid = false;
                document.getElementById("cnfrm-pass").style.border = "2px solid red";
            }

            if (!isValid) {
                // Prevent form submission if any validation fails
                event.preventDefault();
            }
        });
    </script>

</body>

</html>
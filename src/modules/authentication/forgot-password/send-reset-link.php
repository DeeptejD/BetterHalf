<?php
@include '../../config.php';

// stuff related to sending the reset link
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../phpMailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $token = bin2hex(random_bytes(32)); //token
    date_default_timezone_set('Asia/Kolkata');
    $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour'));

    $insertTokenQuery = "INSERT INTO password_reset_tokens (token, otp_expiry, user_email) VALUES ('$token', '$expiryTime', '$email')";
    mysqli_query($conn, $insertTokenQuery);

    $resetLink = "http://localhost/redesign/src/modules/authentication/forgot-password/reset-password.php?token=$token";

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'matrimonydbms@gmail.com';
    $mail->Password = 'jotbnkrvqpkugzcv';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('matrimonydbms@gmail.com', 'Matrimony Project');
    $mail->addAddress($email);
    $mail->Subject = 'Forgot Password Request';
    $mail->isHTML(true);
    $mail->Body = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f3f3f3;
            }
            .container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .link-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #000000;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
            }
            .footer {
                text-align: center;
                margin-top: 20px;
                color: #999999;
            }
        </style>
    </head>
    <body>
        <div class=\"container\">
            <div class=\"header\">
                <h2>Password Reset</h2>
            </div>
            <p>Hello,</p>
            <p>You have requested to reset your password. Click the button below to proceed:</p>
                <a class=\"link-button\" href=\"$resetLink\" style=\"color: white\">Reset Password</a>
            <p>If you did not request this reset, you can safely ignore this email.</p>
            <div class=\"footer\">
                <p>Regards <br>Milaap :)</p>
            </div>
        </div>
    </body>
    </html>
";

    if (!$mail->send()) {
        echo 'Email could not be sent.';
    } else {
        echo "Password reset link sent successfully to email: $email";
    }

}
?>
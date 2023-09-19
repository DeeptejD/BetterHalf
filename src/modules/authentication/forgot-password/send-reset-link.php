<!DOCTYPE html>
<html>

<head>
    <?php include '../../partials/head-content.php'; ?>
    <!-- css to be added later -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- <h1>Forgot Password</h1>
    <form method="POST" action="send-reset-link.php">
        <label for="email">Enter your email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form> -->
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen flex flex-col px-5"
        style="background-image: url('../../../images/dashboard/background-2.jpg');">
        <div class="m-4 mb-0">
            <nav class="w-full h-12 rounded-full p-2 bg-gray-100 flex flex-row justify-between bg-opacity-25 shadow-2xl"
                style="backdrop-filter: blur(8px);">
                <a href=" #" class=" m-2 text-semibold flex justify-center items-center font-semibold pl-6">Logo
                    goes here</a>
                <div class="flex flex-row space-x-4">
                    <a href="../register.php"
                        class=" m-2 text-semibold flex justify-center items-center font-semibold pr-6">Sign
                        Up</a>
                    <a href="../login.php"
                        class=" m-2 text-semibold flex justify-center items-center font-semibold pr-6">Log in</a>
                </div>
            </nav>
        </div>
        <div class="flex-grow bg-white m-4 rounded-xl flex flex-row bg-opacity-25 shadow-2xl"
            style="backdrop-filter: blur(8px);">
            <div class="bg-gray-900 rounded-l-xl w-1/2 h-full overflow-hidden">
                <img src="../../../images/forgot-password/sent-link.gif" alt=""
                    class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
            </div>
            <div class="flex-grow rounded-r-xl ml-5 p-5 flex flex-col justify-center items-center">
                <!-- php starts here -->
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
                <p>Regards</p>
            </div>
        </div>
    </body>
    </html>
";

                    if (!$mail->send()) {
                        echo "<h1 class=\"text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold pb-3 mb-6\">
                        Email could not be sent</h1>";
                    } else {
                        echo "<h1 class=\"text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold pb-3 mb-6\">
                        Password reset link sent successfully to email: $email</h1>";
                        echo "<div class=\"flex flex-row justify-start pt-1 w-full\">
                        <a href=\"https://mail.google.com/mail/u/0/#inbox\" target=\"_blank\"
                            class=\" text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-lime-100 active:bg-lime-200  active:shadow-inner font-semibold transition transform duration-500 hover:scale-110 focus:outline-none\">Open Gmail<a/>
                    </div>";
                    }

                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
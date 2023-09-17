<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Verify OTP</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/stylesotp.css">
</head>
<body>
    <div>
        <div class="form">
            <h1>Verify OTP</h1>
            <form action="verify-otp-process.php" method="POST">
                <div class="nameinput">
                        Enter the OTP sent to your email
                    <br>
                    <input type="text" id="otp" name="otp" required>
                </div>
                <button id="sbmitbtn" type="submit">Verify OTP</button>
            </form>
        </div>
    </div>
</body>
</html>

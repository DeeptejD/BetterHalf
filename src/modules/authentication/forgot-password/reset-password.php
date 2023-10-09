<?php
include '../../config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    if (isset($_POST['new_password'])) {
        $newPassword = $_POST['new_password'];
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updatePasswordQuery = "UPDATE `register` SET user_password = '$newPassword' WHERE user_email = (SELECT user_email FROM password_reset_tokens WHERE token = '$token' AND otp_expiry > NOW())";
        mysqli_query($conn, $updatePasswordQuery);

        $deleteTokenQuery = "DELETE FROM password_reset_tokens WHERE token = '$token'";
        mysqli_query($conn, $deleteTokenQuery);

        echo 'Password reset successfully!';

        header('Location: ../login.php');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="bg-cover bg-center md:overflow-hidden h-screen w-screen flex flex-col md:px-5"
        style="background-image: url('../../../images/dashboard/background-2.jpg');">
        <!-- <form method="POST" action="reset-password.php?token=<?php echo $token; ?>">
            <label for="new_password">Enter your new password:</label>
            <input type="password" name="new_password" required>
            <button type="submit">Reset Password</button>
        </form> -->
        <div class="h-2/3 md:flex-grow bg-white m-4 rounded-xl flex md:flex-row flex-col bg-opacity-25 shadow-2xl mx-48 my-20 shadow-xl"
            style="backdrop-filter: blur(8px);">
            <!-- <div class="bg-gray-900 md:rounded-l-xl rounded-t-xl md:w-1/3 w-full md:h-full h-1/4 overflow-hidden">
                <img src="../../../images/forgot-password/forgot-side.gif" alt=""
                    class="hidden md:block object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
                <img src="../../../images/forgot-password/small-screen.gif" alt=""
                    class="md:hidden block object-cover rounded-t-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
            </div> -->
            <div class="flex-grow rounded-r-xl md:ml-5 p-5 flex flex-col justify-center items-center">
                <form method="POST" action="reset-password.php?token=<?php echo $token; ?>" class="w-full md:py-6 px-2">
                    <h1 class="text-gray-100  text-2xl md:text-3xl font-bold md:pb-3 md:mb-6 pb-1 mb-2">
                        Enter your new password</h1>
                    <div class="pt-2">
                        <label for="new_password"
                            class="text-white text-lg font-semibold shadow-2xl pl-2">Password</label>
                        <input type="password" name="new_password" id="new_password"
                            placeholder="Enter your new password" required
                            class="w-full rounded-2xl shadow-2xl bg-gray-50 p-5  focus:outline-none">
                    </div>
                    <div class="flex flex-row justify-end pt-5 md:pt-11">
                        <input type="submit" name="submit" id="submit"
                            class="md:w-1/5 w-full shadow-2xl text-center p-5 h-full rounded-xl bg-lime-100 hover:bg-lime-100 active:bg-lime-200  active:shadow-inner font-semibold transition transform duration-500 hover:scale-90 active:scale-80 focus:outline-none" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
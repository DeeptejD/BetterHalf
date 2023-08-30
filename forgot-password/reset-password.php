<?php
include '../views/config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    if (isset($_POST['new_password'])) {
        $newPassword = $_POST['new_password'];
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updatePasswordQuery = "UPDATE `register` SET user_password = '$newPassword' WHERE user_email = (SELECT user_email FROM password_reset_tokens WHERE token = '$token' AND token_expiry > NOW())";
        mysqli_query($conn, $updatePasswordQuery);

        $deleteTokenQuery = "DELETE FROM password_reset_tokens WHERE token = '$token'";
        mysqli_query($conn, $deleteTokenQuery);

        echo 'Password reset successfully!';

        header('Location: ../views/login.php');
        exit();
    }
}
?>

<form method="POST" action="reset-password.php?token=<?php echo $token; ?>">
    <label for="new_password">Enter your new password:</label>
    <input type="password" name="new_password" required>
    <button type="submit">Reset Password</button>
</form>

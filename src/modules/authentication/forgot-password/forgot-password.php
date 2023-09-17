<?php include '../../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <?php include '../../partials/head-content.php'; ?>
    <!-- css to be added later -->
</head>
<body>
    <h1>Forgot Password</h1>
    <form method="POST" action="send-reset-link.php">
        <label for="email">Enter your email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
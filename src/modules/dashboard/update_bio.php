<?php
@include '../config.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header('location: ../authentication/login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['bio'])) {
        $newBio = $_POST['bio'];

        $uid = $_SESSION['user_email'];

        $newBio = mysqli_real_escape_string($conn, $newBio);
        $updateQuery = "UPDATE `details` SET `bio` = '$newBio' WHERE `user_email` = '$uid'";
        $result = mysqli_query($conn, $updateQuery);

        // close
        mysqli_close($conn);

    }
}
?>
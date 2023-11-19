<?php
    session_start();
    include_once "../config.php";

    if (!isset($_SESSION['user_email'])) {
    header('location:../authentication/login.php');
    }

    $sender_id = $_SESSION['user_email'];
    $receiver_id = $_POST['userEmail'];

    $query = "INSERT INTO interest_requests (sender_id, receiver_id) VALUES ('$sender_id', '$receiver_id')";
    mysqli_query($conn, $query);

    echo "Success";
?>
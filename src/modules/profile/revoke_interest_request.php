<?php
session_start();
include_once "../config.php";

if (!isset($_SESSION['user_email'])) {
    header('location:../authentication/login.php');
}

$sender_id = $_SESSION['user_email'];
$receiver_id = $_POST['userEmail'];

$query = "DELETE FROM `interest_requests` WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id'";
mysqli_query($conn, $query);

echo "Success";
?>
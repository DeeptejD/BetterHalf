<?php

session_start();
include_once "../config.php";
if (!isset($_SESSION['user_email'])) {
    header('location:../authentication/login.php');
}

$sender_id = $_SESSION['user_email'];
$receiver_id = $_POST['userEmail'];

// delete from matched
$query = "DELETE FROM `matched_pairs` WHERE user1 = '$sender_id' AND user2 = '$receiver_id'";
mysqli_query($conn, $query);

$query = "DELETE FROM `matched_pairs` WHERE user1 = '$receiver_id' AND user2 = '$sender_id'";
mysqli_query($conn, $query);



?>
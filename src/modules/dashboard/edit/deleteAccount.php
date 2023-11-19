<?php

session_start();
include_once "../../config.php";

if (!isset($_SESSION['user_email'])) {
    header('location: ../../authentication/login.php');
}

$ID = $_SESSION['user_email'];

$query = "DELETE FROM `details` WHERE user_email = '$ID'";
mysqli_query($conn, $query);

$query = "DELETE FROM `interest_requests` WHERE sender_id = '$ID'";
mysqli_query($conn, $query);

$query = "DELETE FROM `interest_requests` WHERE receiver_id = '$ID'";
mysqli_query($conn, $query);

$query = "DELETE FROM `register` WHERE user_email = '$ID'";
mysqli_query($conn, $query);

$query = "DELETE FROM `calendar` WHERE user_email = '$ID'";
mysqli_query($conn, $query);

$delMap = "DELETE FROM `gis` WHERE user_email = '$ID'";
mysqli_query($conn, $delMap);

$delm1 = "DELETE FROM `matched_pairs` WHERE user1 = '$ID'";
mysqli_query($conn, $delm1);

$delm2 = "DELETE FROM `matched_pairs` WHERE user2 = '$ID'";
mysqli_query($conn, $delm2);

$delmessagein = "DELETE FROM `messages` WHERE outgoing_msg_id = '$ID'";
mysqli_query($conn, $delmessagein);

$delmessageout = "DELETE FROM `messages` WHERE incoming_msg_id = '$ID'";
mysqli_query($conn, $delmessageout);

$delotp = "DELETE FROM `otp_data` WHERE user_email = '$ID'";
mysqli_query($conn, $delotp);


header('location:../../authentication/register.php');

?>
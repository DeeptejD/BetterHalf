<?php

session_start();
include_once "../config.php";

if (!isset($_SESSION['user_email'])) {
    header('location:../authentication/login.php');
}

$request_id = $_POST['request_id'];
$action = $_POST['action'];

if (strtoupper($action) === 'ACCEPT') {
    $query = "UPDATE interest_requests SET status = 'accepted' WHERE request_id = '$request_id'";
    mysqli_query($conn, $query);
} else {
    $query = "DELETE FROM interest_requests WHERE request_id = '$request_id'";
    mysqli_query($conn, $query);
}


?>
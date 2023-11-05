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

    $query = "SELECT * FROM interest_requests WHERE request_id = '$request_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $sender_id = $row['sender_id'];
    $receiver_id = $row['receiver_id'];

    $insert_match = "INSERT INTO `matched_pairs` (user1, user2) VALUES ('$sender_id', '$receiver_id')";
    $query = mysqli_query($conn, $insert_match);

    $insert_match = "INSERT INTO `matched_pairs` (user1, user2) VALUES ('$receiver_id', '$sender_id')";
    $query = mysqli_query($conn, $insert_match);

    $delete_request = "DELETE FROM interest_requests WHERE request_id = '$request_id'";
    mysqli_query($conn, $delete_request);

} else {
    $query = "DELETE FROM interest_requests WHERE request_id = '$request_id'";
    mysqli_query($conn, $query);
}


?>
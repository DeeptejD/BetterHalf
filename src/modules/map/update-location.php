<?php
include '../config.php';

session_start();

if (!isset($_SESSION['user_email'])) {
    header('location:../authentication/login.php');
}

$userEmail = $_SESSION['user_email'];

// Get the POST data sent from map (JSON)
$data = json_decode(file_get_contents("php://input"));

$latitude = floatval($data->latitude);
$longitude = floatval($data->longitude);

if ($data && isset($data->latitude, $data->longitude)) {
    $query = "INSERT INTO `GIS` (latitude, longitude, user_email) VALUES ('$latitude', '$longitude', '$userEmail') ON DUPLICATE KEY UPDATE latitude = '$latitude', longitude = '$longitude'";
    mysqli_query($conn, $query);

} else {
    echo "No data sent";
}
?>
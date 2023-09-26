<?php
session_start();

// Check if the user is logged in (adjust this according to your authentication mechanism)
if (!isset($_SESSION['user_email'])) {
    echo "User is not logged in.";
    exit();
}

// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "loginpage"; // gotta change the name wth

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch events for the logged-in user
    $user_email = $_SESSION['user_email'];
    $stmt = $conn->prepare("SELECT event_id, title, start_date, end_date FROM calendar WHERE user_email = :user_email");
    $stmt->bindParam(':user_email', $user_email);
    $stmt->execute();

    $events = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $events[] = [
            'id' => $row['id'],
            'title' => $row['event_title'],
            'start' => $row['start_date'],
            'end' => $row['end_date'],
            // 'description' => $row['event_description'],
            'url' => $row['url']
        ];
    }

    // return as a json object
    echo json_encode($events);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
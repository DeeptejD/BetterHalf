<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    echo "User is not logged in.";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "loginpage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user_email = $_SESSION['user_email'];
    $event_title = $_POST['event_title'];
    $start_date = $_POST['startDate'];
    $start_time = $_POST['startTime'];
    $start_date = $start_date . "T" . $start_time;
    $end_date = $_POST['endDate'];
    $end_time = $_POST['endTime'];
    $end_date = $end_date . "T" . $end_time;
    $event_description = $_POST['eventDescription'];
    $event_link = $_POST['eventLink'];
    if (isset($_POST['allDay']))
        $all_day = $_POST['allDay'];
    else
        $all_day = 0;
    $color = $_POST['color'];

    $stmt = $conn->prepare("INSERT INTO calendar (user_email, event_title, start_date, end_date, event_description, event_link, allDay, color) VALUES (:user_email, :event_title, :start_date, :end_date, :event_description, :event_link, :all_day, :color)");

    $stmt->bindParam(':user_email', $user_email);
    $stmt->bindParam(':event_title', $event_title);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':event_description', $event_description);
    $stmt->bindParam(':event_link', $event_link);
    $stmt->bindParam(':all_day', $all_day);
    $stmt->bindParam(':color', $color);


    $stmt->execute();

    echo "Record inserted successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


// refresh
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user_email = $_SESSION['user_email'];
    $stmt = $conn->prepare("SELECT id, event_title, start_date, end_date, event_link, allDay, color FROM calendar WHERE user_email = :user_email");
    $stmt->bindParam(':user_email', $user_email);
    $stmt->execute();

    $events = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $startDateTime = new DateTime($row['start_date']);
        $endDateTime = new DateTime($row['end_date']);

        $formattedStart = $startDateTime->format('Y-m-d\TH:i:s');
        $formattedEnd = $endDateTime->format('Y-m-d\TH:i:s');

        $event = new stdClass();
        $event->id = $row['id'];
        $event->title = $row['event_title'];
        $event->start = $formattedStart;
        $event->end = $formattedEnd;
        $event->allDay = $row['allDay'];
        $event->url = $row['event_link'];
        $event->color = $row['color'];

        $events[] = $event;
    }

    // echo json_encode($events);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// brk conn
$conn = null;

// return to the calendar
header("location: calendar.php");
?>
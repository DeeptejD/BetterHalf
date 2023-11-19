<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("location: ../not_logged_in.html");
}

$eventId = isset($_POST['event_id']) ? $_POST['event_id'] : null;
// echo $eventId; 

if ($eventId != null) {
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "loginpage";

        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $user_email = $_SESSION['user_email']; // session user email

        $sql = $conn->prepare("DELETE FROM calendar WHERE id = :event_id AND user_email = :user_email");
        $sql->bindParam(':user_email', $user_email);
        $sql->bindParam(':event_id', $eventId);

        $sql->execute();

        echo "Event deleted successfully";

        $events = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
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

} else {
    echo 'Event ID was not set';
}

$conn = null;

?>
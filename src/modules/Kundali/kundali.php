<?php
    session_start();
    include_once "../config.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hours = $_POST["hours"];
        $minutes = $_POST["minutes"];
        $seconds = $_POST["seconds"] ?? 0; // Seconds are optional

        // Validate input values
        if ($hours >= 0 && $hours <= 23 && $minutes >= 0 && $minutes <= 59 && $seconds >= 0 && $seconds <= 59) {
            echo "<h2>Entered Time:</h2>";
            echo "Time: $hours:$minutes:$seconds";
        } else {
            echo "<p>Invalid time input. Please enter valid time values.</p>";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $place = $_POST["place"];
        // Validate input value
        if (!empty($place)) {
            echo "<h2>Entered Place:</h2>";
            echo "Place: $place";
        } else {
            echo "<p>Invalid place input. Please enter a place.</p>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kundali Matchmaking</title>
</head>
<body>
    <h1>Kundali Matchmaking</h1>
    <form method="post" action="matchmaking.php">
        <label for="hours">Hours:</label>
        <input type="number" name="hours" min="0" max="23" required><br><br>
        
        <label for="minutes">Minutes:</label>
        <input type="number" name="minutes" min="0" max="59" required><br><br>
        
        <label for="seconds">Seconds:</label>
        <input type="number" name="seconds" min="0" max="59"><br><br>


        <h1>Where were you born?</h1>
        <label for="place-input">Enter a Place:</label>
        <input type="text" id="place-input" placeholder="Enter a place" required><br><br>
        

        
        <input type="submit" name="submit" value="Find Match">
    </form>

</body>
</html>

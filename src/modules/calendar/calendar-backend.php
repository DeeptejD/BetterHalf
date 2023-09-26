<!-- calendar backend code -->
<?php

@include '../config.php';

session_start();

if (isset($_POST['submit'])) {

    // retrieve user email from session
    $email = $_SESSION['user_email'];

    // check if the email exists in the register table
    $select = "SELECT * FROM `register` WHERE user_email = '$email'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 0) {
        echo '<script> 
                window.location.href = "calendar.html";
                alert("Please register first.");
            </script>';
    } else {
        $email = $_SESSION['user_email'];
    }

    $title = $_POST['title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $insert = "INSERT INTO `calendar` (`user_email`, `event_title`, `start_date`, `end_date`, `event_description`, `event_link`) VALUES ('$email', '$title', '$start_date', '$end_date', '$description', '$link')";
    $result = mysqli_query($conn, $insert);

    if ($result) {
        echo '<script> 
                window.location.href = "calendar.php";
                alert("Event added successfully.");
            </script>';
    } else {
        echo '<script> 
                window.location.href = "calendar.php";
                alert("Event could not be added.");
            </script>';
    }
    
}
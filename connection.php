<?php
    $username = "root";
    $password = "";
    $db_name = "loginpage";

    $user_name = $_POST('username');
    $password = $_POST('password');
    $email = $_POST('email');

    $conn = new mysqli('localhost', $username, $password, $db_name);
    if($conn->connect_error){
        die("connection failed" . $conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("insert into register(user_name, user_email, user_password)values(?, ?, ?);");
        $stmt->bind_param("sss", $user_name, $email, $password);
        $stmt->execute();
        echo "success";
        $stmt->close();
        $conn->close();
    }
?>
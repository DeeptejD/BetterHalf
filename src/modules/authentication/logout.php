<?php
    session_start();
    if(isset($_SESSION['user_email'])){
        include_once "../config.php";
        $logout_id = mysqli_real_escape_string($conn, $_SESSION['user_email']);
        if(isset($logout_id)){
            $status = "Offline";
            $sql = mysqli_query($conn, "UPDATE register SET status = '{$status}' WHERE user_email='{$_SESSION['user_email']}'");
            if($sql){
                session_unset();
                session_destroy();
                header("location: login.php");
            }
        }else{
            header("location: ../dashboard/dash.php");
        }
    }else{  
        header("location: login.php");
    }
?>
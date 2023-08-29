<?php

@include 'config.php';

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $select = "SELECT user_password FROM `register` WHERE user_email = '$email' and user_password = '$pass'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count == 1){
        header("location: home.php");
    }
    else{
        echo '  <script>
                    window.location.href = "index.php";
                    alert("login failed. Please check your username and password");
                </script>';
    }

    // if ($row && password_verify($pass, $row['user_password'])) {
    //     session_start();
    //     $_SESSION['user_id'] = $row['user_id'];
    //     header("location: home.php");
    //     exit();
    // } else {
    //     echo '<script> 
    //             window.location.href = "login.php";
    //             alert("Login failed. Please check your credentials.");
    //         </script>';
    // }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <?php include './partials/head-content.php'; ?>
        <link rel="stylesheet" href="../assets/css/styleslgn.css">
    </head>
    <body>
        <div class="link">
            <a href="register.php">Sign Up</a>
        </div>
            <video id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
                <source src="../assets/GradientBg.mp4" type="video/mp4">
            </video>

            <div class="form">
            <h1 class="deez">Sign In</h1>
            <form action="login.php" method="POST">
                <div class="nameinput">
                    Email Address
                <br>
                <input type="email" name="email" placeholder="Enter Your Email Id">
                </div>
                <div class="nameinput">
                    Password
                <br>
                <input id="pass" type="password" name="password" placeholder="Enter Your Password">
                </div>
                <div class="nameinput">
                    <a href="../forgot-password/forgot-password.php" >Forgot Password?</a>
                </div>
                <div class="nameinput">
                    <a href="register.php" >Don't have an account?</a>
                </div>
                <input id="sbmitbtn" type="submit" name="submit" value="Submit">

            </form>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script src="index.js" async defer></script>
    </body>
</html>
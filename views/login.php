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
        <!-- <link rel="stylesheet" href="../assets/css/styleslgn.css"> -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style type="text/tailwindcss">
            @layer utilities {
            .bgi{
                background: url(images/bg.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            html{
                overflow:hidden;
            }
            }
        </style>
    </head>
<<<<<<< HEAD
    <body class="flex-col justify-center items-center">
        <nav class="h-10">
            <div>
                <a href="register.php" >Sign Up</a>
            </div>
        </nav>
        <div class="z-0 p-2 h-screen w-screen bg-repeat-x bg-contain bg-center flex justify-center items-center " style="background-image: url(bg.jpg);">
           
            <div class=" rounded-2xl w-72 h-2/3 bg-white p-2 mr-4 text-black flex justify-center items-center  shadow-2xl">
                <form class="flex-col" action="login.php" method="POST">
                    <h1 class="ml-10 mb-10 font-bold text-4xl">Sign In</h1>
                    <div class="mb-5">
                        Email Address
                    <br>
                    <input class=" p-2 border-2 rounded-xl text-black  border-black" type="email" name="email" placeholder="Enter Your Email Id">
                    </div>
                    <div class="mb-8">
                        Password
                    <br>
                    <input  class=" p-2 border-2 rounded-xl text-black  border-black" id="pass" type="password" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="mb-8">
                        <a href="../forgot-password/forgot-password.php" >Forgot Password?</a>
                    </div>
                    <div class="mb-8">
                        <a href="register.php" >Don't have an account?</a>
                    </div>
                    <input class="mb-5 p-3 w-52 bg-black rounded-xl text-white hover:border-2 hover:border-black hover:bg-white hover:text-black" type="submit" name="submit" value="Submit">
=======
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
                <input id="password" type="password" name="password" placeholder="Enter Your Password">
                </div>
                <div class="nameinput">
                    <a href="../forgot-password/forgot-password.php" >Forgot Password?</a>
                </div>
                <div class="nameinput">
                    <a href="register.php" >Don't have an account?</a>
                </div>
                <input id="sbmitbtn" type="submit" name="submit" value="Submit">
>>>>>>> 1a3c91168e7b05cda5613dae24f8f79620116307

                </form>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="index.js" async defer></script>
    </body>
</html>
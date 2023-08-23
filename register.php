<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM `register` WHERE user_email = '$email' && user_password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{
        if(($name == "")||($email == "")||($pass != $cpass)){
         $error[] = 'Registration Failed. Please recheck your entered details.';
        }
        else{
         $insert = "INSERT INTO `register`(user_name, user_email, user_password) VALUES('$name','$email','$pass')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Registration</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    </head>
    <body>
            <nav class="link">
                    <a href="login.php">Sign In</a>
            </nav>
            <video id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
                <source src="GradientBg.mp4" type="video/mp4">
                </video>

                

                <div class="form">
                    <h1 class="deez">Create an account</h1>
                    <form action="" method="POST">
                            <?php
                                if(isset($error)){
                                    foreach($error as $error){
                                        echo '<span color="white" class="error-msg">'.$error.'</span>';
                                    };
                                };
                            
                            ?>
                        <div class="nameinput">
                            Name
                            <br>
                            <input id="name" type="text" placeholder="Enter Your Name" name="username">
                        </div>
                        <div class="nameinput">
                            Email Address
                        <br>
                        <input id="email" type="email" placeholder="Enter You Email Id" name="email">
                        </div>
                        <div class="nameinput">
                            Password
                        <br>
                        <input id="pass" type="password" placeholder="Enter You Password" name="password">
                        </div>
                        <div class="nameinput">
                            Confirm Password
                        <br>
                        <input id="cnfrm-pass" type="password" placeholder="Enter Your Password" name="cpassword">
                        </div>
                        <input id="sbmitbtn" type="submit" value="Submit" name="submit">
                    </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script>
                    $("#sbmitbtn").on("click",function(){
        // var deez = $("#pass").value;
        var deez = document.getElementById("pass").value;
        var deeze = document.getElementById("email").value;
        var deezn = document.getElementById("name").value;
        var cnfpswd = document.getElementById("cnfrm-pass").value;
        

        if((deezn.length == 0)) {
            alert("Enter A Name");
            document.getElementById("pass").value = "";
            document.getElementById("cnfrm-pass").value = "";
        }
        if((deeze.length == 0)) {
            alert("Enter Valid Email Please");
            document.getElementById("pass").value = "";
            document.getElementById("cnfrm-pass").value = "";
        }
        if ((deez !== cnfpswd)) {
            alert("The Passwords entered differ!");
            document.getElementById("pass").value = "";
            document.getElementById("cnfrm-pass").value = "";
        }
        if((deez.length < 8)) {
            alert("Password must exceed 8 characters");
            document.getElementById("pass").value = "";
            document.getElementById("cnfrm-pass").value = "";
        }
    })
            </script>
    </body>
</html>
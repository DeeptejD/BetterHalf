<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styleslgn.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="link">
            <a href="register.php">Sign Up</a>
        </div>
            <video id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
                <source src="GradientBg.mp4" type="video/mp4">
                </video>

                <div class="form">
                    <h1 class="deez">Sign In</h1>
                    <form action="">
                        <div class="nameinput">
                            Email Address
                        <br>
                        <input type="email" placeholder="Enter You Email Id">
                        </div>
                        <div class="nameinput">
                            Password
                        <br>
                        <input id="pass" type="password" placeholder="Enter You Password">
                        </div>
                        <input id="sbmitbtn" type="button" value="Submit">

                    </form>
                </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script src="index.js" async defer></script>
    </body>
</html>
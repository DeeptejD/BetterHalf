<?php

@include '../config.php';

if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $pass = $_POST['password'];

  $select = "SELECT user_password FROM `register` WHERE user_email = '$email'";
  $result = mysqli_query($conn, $select);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);

  if (password_verify($pass, $row['user_password'])) {
    session_start();
    // i commented this cuz the new database does not have a user_id attribute
    // $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_email'] = $row['user_email'];
    echo "verified";
    header("location: ../get-started/get-started.php");
    exit();
  } else {
    echo "not verified";
    echo '<script> 
                window.location.href = "";
                alert("Login failed. Please check your credentials.");
            </script>';
  }
}
?>
<!doctype html>
<html>

<head>
  <?php include '../partials/head-content.php'; ?>
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- <link rel="stylesheet" href="../../build/css/tailwind.css" /> -->
  <style>
    ::selection {
      background-color: rgb(197, 242, 197);
      color: black;
    }
  </style>
</head>

<body>
  <div class="bg-cover bg-center md:overflow-hidden h-full md:h-screen w-screen flex flex-col md:px-5"
    style="background-image: url('../../images/dashboard/background-2.jpg');">
    <!-- this right here is the nav -->
    <div class="m-4 mb-0">
      <nav class="w-full h-12 rounded-full md:p-2 bg-gray-100 flex flex-row justify-between bg-opacity-25 shadow-xl"
        style="backdrop-filter: blur(8px);">
        <a href=" #" class="hidden md:block m-2 text-semibold flex justify-center items-center font-semibold pl-6">Logo
          goes here</a>
        <a href=" #" class=" md:hidden m-2 text-semibold flex justify-center items-center font-semibold pl-6">Logo</a>
        <div class="flex flex-row space-x-4">
          <a href="../register.php" class=" m-2 text-semibold flex justify-center items-center font-semibold pr-6">Sign
            Up</a>
        </div>
      </nav>
    </div>

    <!-- this is where the part under the nav starts -->
    <div class="flex-grow bg-white m-4 rounded-xl rounded-t-xl flex flex-col md:flex-row bg-opacity-25 shadow-xl"
      style="backdrop-filter: blur(8px);">
      <div class="bg-gray-900 md:rounded-l-xl rounded-t-xl w-full h-1/3 md:w-1/3 md:h-full overflow-hidden">
        <img src="../../images/login/hero-gif.gif" alt=""
          class="hidden md:block object-cover md:rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
        <img src="../../images/login/hero-mobile.gif" alt=""
          class="md:hidden block object-cover rounded-t-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
      </div>
      <div class="flex-grow rounded-r-xl md:ml-5 p-5 flex flex-col justify-center items-center">
        <form action="login.php" method="post" class="w-full py-2 md:py-6 px-2">
          <h1 class="text-gray-100  text-2xl md:text-3xl font-bold md:pb-3 md:mb-6 pb-1 mb-2">
            Enter your Login Info</h1>
          <div class="pt-2">
            <label for="email" class="text-white text-lg font-semibold shadow-xl pl-2">Email</label>
            <input type="email" name="email" id="email"
              class="w-full rounded-2xl shadow-xl bg-white p-5  focus:outline-none">
          </div>
          <div class="pt-2">
            <label for="password" class="text-white text-lg font-semibold shadow-xl pl-2">Password</label>
            <input type="password" name="password" id="pass"
              class="w-full rounded-2xl shadow-xl bg-white p-5  focus:outline-none">
          </div>
          <div
            class="flex flex-col md:flex-row pt-6 items-center justify-center md:justify-start space-y-4 md:space-y-0 md:space-x-6">
            <a href="./forgot-password/forgot-password.php" class="text-white text-md text-base underline">Forgot
              Password?</a>
            <a href="register.php" class="text-white text-md text-base underline">Dont have an account?</a>
          </div>
          <div class="flex flex-row justify-end pt-11">
            <input type="submit" name="submit" id="submit"
              class="md:w-1/5 w-full shadow-2xl text-center p-5 h-full rounded-xl bg-lime-100 hover:bg-lime-100 active:bg-lime-200  active:shadow-inner font-semibold transition transform duration-500 hover:scale-90 active:scale-80 focus:outline-none" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="index.js" async defer></script>
</body>

</html>
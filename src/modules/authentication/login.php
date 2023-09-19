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
  <div class="bg-cover bg-center overflow-hidden h-screen w-screen flex flex-col px-5"
    style="background-image: url('../../images/dashboard/background-2.jpg');">
    <!-- this right here is the nav -->
    <div class="m-4 mb-0" style="backdrop-filter: blur(8px);">
      <nav class="w-full h-12 rounded-full p-2 bg-gray-100 flex flex-row justify-between bg-opacity-25 shadow-2xl"
        style="backdrop-filter: blur(8px);">
        <a href=" #" class=" m-2 text-semibold flex justify-center items-center font-semibold pl-6">Logo
          goes here</a>
        <a href="register.php" class=" m-2 text-semibold flex justify-center items-center font-semibold pr-6">Sign
          Up</a>
      </nav>
    </div>

    <!-- this is where the part under the nav starts -->
    <div class="flex-grow bg-white m-4 rounded-xl flex flex-row bg-opacity-25 shadow-2xl"
      style="backdrop-filter: blur(8px);">
      <div class="bg-gray-900 rounded-l-xl w-1/3 h-full overflow-hidden">
        <img src="../../images/login/hero-gif.gif" alt=""
          class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
      </div>
      <div class="flex-grow rounded-r-xl ml-5 p-5 flex flex-col justify-center items-center">
        <form action="login.php" method="post" class="w-full py-6 px-2">
          <h1 class="text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold pb-3 mb-6">
            Enter your Login Info</h1>
          <div class="pt-2">
            <label for="email" class="text-white text-lg font-semibold shadow-2xl pl-2">Email</label>
            <input type="email" name="email" id="email"
              class="w-full rounded-2xl shadow-2xl bg-gray-200 p-5  focus:outline-none">
          </div>
          <div class="pt-2">
            <label for="password" class="text-white text-lg font-semibold shadow-2xl pl-2">Password</label>
            <input type="password" name="password" id="pass"
              class="w-full rounded-2xl shadow-2xl bg-gray-200 p-5  focus:outline-none">
          </div>
          <div class="flex flex-row pt-6 space-x-6">
            <a href="./forgot-password/forgot-password.php" class="text-white text-md text-base underline">Forgot
              Password?</a>
            <a href="register.php" class="text-white text-md text-base underline">Dont have an account?</a>
          </div>
          <div class="flex flex-row justify-end pt-11">
            <input type="submit" name="submit" id="submit"
              class="w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-lime-100 active:bg-lime-200  active:shadow-inner font-semibold transition transform duration-500 hover:scale-110 focus:outline-none" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="index.js" async defer></script>
</body>

</html>
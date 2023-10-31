<?php
@include '../config.php';
session_start();
$uid = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM `details` WHERE user_id = '$uid'");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$pfp = $row['imgurl'];
$name = $_SESSION['user_name'];
$biodat = $row['bio'];
if (isset($_POST['submit'])) {
  session_destroy();
  header('location:../authentication/login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <link rel="stylesheet" href="../../build/css/tailwind.css"> -->
  <script src="https://cdn.tailwindcss.com"></script>

  <title>Home</title>
</head>

<body>
  <div class="bg-cover bg-center overflow-hidden h-screen w-screen"
    style="background-image: url('../../images/dashboard/background.jpg');">
    <div class="flex justify-between h-full py-3">
      <div class="mx-0 pr-4 h-full w-1/4">
        <div class=" shadow-2xl rounded-r-xl h-full">
          <div class="flex flex-row col-span-2 h-full bg-gray-700 rounded-r-xl shadow-2xl bg-opacity-50 p-4"
            style="backdrop-filter: blur(8px);">
            <nav class=" flex flex-col justify-between h-full w-full rounded-xl p-4">
              <div class="h-4/5 space-y-4">
                <div class="flex flex-row items-center justify-center">
                  <a href="../dashboard/dash.html">
                    <img src="../../images/OG-images/logo.png" class="h-28 w-28">
                  </a>
                </div>
                <div class="h-1/2 w-full rounded-xl space-y-4">
                  <button
                    class="text-white md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-2xl text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                    Home
                  </button>
                  <button
                    class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                    Chat
                  </button>
                  <a href="../calendar/calendar.php">
                    <button
                      class="text-white  text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                      Calendar
                    </button>
                  </a>
                  <button
                    class="text-white  text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                    Kundali
                  </button>
                  <button
                    class="text-white  text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl mb-14 bg-opacity-50 transform duration-100 hover:scale-105">
                    Map
                  </button>
                </div>
              </div>
              <div class="h-1/5">
                <div class="rounded-xl w-full h-full pt-10">
                  <form action="" method="post">
                    <a name="logout" href="../authentication/login.php">
                      <button type="submit" name="submit"
                        class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl hover:bg-red-700 hover:text-white hover:opacity-100 transition ease-in-out hover:shadow-2xl space-y-12 bg-opacity-30 transform duration-100 hover:scale-105 w-full ">
                        Log-Out
                      </button>
                  </form>
                  </a>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
      <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
        <div class="col-span-9 row-span-3 pr-4 rounded-xl">
          <div class="flex flex-row w-full h-full bg-gray-900 bg-opacity-50 shadow-2xl rounded-xl p-4" style="backdrop-filter: blur(8px);">
            <div class="w-full h-full rounded-xl flex flex-row space-x-4">
              <div class="w-1/3 h-full bg-gray-300 rounded-l-xl overflow-hidden">
                <img src="<?php echo $pfp; ?>" alt="Profile picture"
                  class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
              </div>
              <div class="w-2/3 h-full rounded-xl flex flex-col space-y-4">
                <div
                  class="bg-gray-900 bg-opacity-25 text-white p-2 w-full h-1/3 rounded-xl flex justify-center items-center">
                  <h1 class="font-sans font-thin font-semibold text-4xl text-center" >Hi!
                    <span class="font-semibold">
                      <?php echo $name; ?>
                    </span>
                  </h1>
                </div>
                <div class="bg-gray-900 bg-opacity-25 text-white p-2 w-full h-2/3 font-thin rounded-xl" >
                  <h3 class="text-xl text-center">Bio</h3>
                  <div class="text-center text-2xl font-semibold mt-5">
                    <?php echo $biodat; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-row gap-4 pb-0 pr-4 col-span-9 row-span-4 row-start-4">
          <div
            class="col-span-3 w-1/3 row-span-3 bg-gray-700 rounded-2xl shadow-2xl bg-opacity-60 transition ease-in-out transform duration-500 hover:scale-105 "
            style="backdrop-filter: blur(8px);">
          </div>
          <div
            class="col-span-3 col-start-3 w-1/3 row-span-3 bg-gray-700 rounded-2xl shadow-2xl bg-opacity-60 transition ease-in-out transform duration-500 hover:scale-105 "
            style="backdrop-filter: blur(8px);">
          </div>
          <divs
            class="col-span-3 w-1/3 bg-gray-700 rounded-2xl bg-opacity-60 transition duration-500 ease-in-out transform hover:scale-105"
            style="backdrop-filter: blur(8px);">
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>
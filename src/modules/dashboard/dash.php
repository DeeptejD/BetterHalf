<?php
@include '../config.php';
session_start();

if (!isset($_SESSION['user_email'])) {
  header('location:../authentication/login.php');
}

// fetching the details of the user that is current logged in
// to be displayed on the dashboard
$uid = $_SESSION['user_email'];
$result = mysqli_query($conn, "SELECT * FROM `details` WHERE user_email = '$uid'");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$pfp = $row['imgurl'];
$name = $_SESSION['user_name'];
$biodat = $row['bio'];
$gender = $row['gender'];
// if (isset($_POST['submit'])) {
//   session_destroy();
//   header('location:../authentication/login.php');
// }

// query to fetch users to be displayed under available users
$sql = "SELECT * FROM details  WHERE user_email != '$uid' AND gender != '$gender'";
$result = $conn->query($sql);
?>

<!-- PHP ends here -->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <link rel="stylesheet" href="../../build/css/tailwind.css"> -->
  <script src="https://cdn.tailwindcss.com"></script>

  <title>Dashboard</title>
  <link rel="icon" type="image/x-icon" href="../../images/dashboard/favicon.ico">



  <style>
    /* For Webkit-based browsers (Chrome, Safari and Opera) */
    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }

    /* For IE, Edge and Firefox */
    .scrollbar-hide {
      -ms-overflow-style: none;
      /* IE and Edge */
      scrollbar-width: none;
      /* Firefox */
    }
  </style>
</head>

<body>
  <div class="bg-cover bg-center overflow-hidden h-screen w-screen"
    style="background-image: url('../../images/dashboard/background.jpg');">
    <div class="flex justify-between h-full py-3">

      <!-- nav -->
      <?php include '../../modules/partials/nav.php' ?>

      <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
        <div class="col-span-9 row-span-3 pr-4 rounded-xl">
          <div class="flex flex-row w-full h-full bg-gray-900 bg-opacity-50 shadow-2xl rounded-xl p-4"
            style="backdrop-filter: blur(8px);">
            <div class="w-full h-full rounded-xl flex flex-row space-x-4">
              <div class="w-1/3 h-full bg-gray-300 rounded-xl overflow-hidden shadow-xl">
                <img src="<?php echo $pfp; ?>" alt="Profile picture"
                  class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
              </div>
              <div class="w-2/3 h-full rounded-xl flex flex-col space-y-4">

                <!-- displayed the name of the user logged in with the greeting -->
                <div
                  class="bg-gray-900 bg-opacity-25 text-white p-2 w-full h-1/3 rounded-xl flex justify-center items-center">
                  <h1 class="font-sans font-thin font-semibold text-4xl text-center">Hi!
                    <span class="font-semibold">
                      <?php echo $name; ?>
                    </span>
                  </h1>
                </div>

                <!-- displays the biodata of the currently logged in user -->
                <div class="bg-gray-900 bg-opacity-25 text-white p-2 w-full h-2/3 font-thin rounded-xl">
                  <h3 class="text-xl text-center">Bio</h3>
                  <div class="text-center text-2xl font-semibold mt-5">
                    <?php echo $biodat; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- these are the three blocks under -->
        <div class="flex flex-row gap-4 pb-0 pr-4 col-span-9 row-span-4 row-start-4">

          <!-- block 1: shows available users -->
          <div
            class="overflow-hidden flex flex-col col-span-3 w-1/3 row-span-3 bg-gray-700 rounded-2xl shadow-2xl bg-opacity-60 transition ease-in-out transform duration-500 hover:scale-105 "
            style="backdrop-filter: blur(8px);">

            <!-- heading -->
            <div class="w-full h-fit ">
              <h1 class='font-sans mt-2 text-2xl text-center text-white mt-5'>Available Users</h1>
            </div>

            <!-- vertically scrollable div -->
            <div class="w-full h-full overflow-y-auto overflow-x-hidden scrollbar-hide">

              <!-- php code to fetch users -->
              <?php



              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $current_email = $row['user_email'];

                  echo '<a href="../profile/user_profile.php?current_user_email=' . $current_email . '">';
                  echo '<div class="w-full transform transition transition-all duration-500 hover:-translate-y-1 hover:translate-x-1">';

                  // profile image
                  echo '<div class="flex bg-white m-3 p-2 bg-opacity-30 rounded-xl bg-cover bg-center ">';
                  echo '<img src="' . $row['imgurl'] . '" alt="Profile Picture" class="object-cover rounded-lg shadow-xl h-16 w-16 m-2">';

                  // fetching the name of the user to be displayed
              

                  $fetch_sql = "SELECT * FROM `register` WHERE user_email = '$current_email'";
                  $fetch_result = $conn->query($fetch_sql);
                  $fetch_row = $fetch_result->fetch_assoc();

                  echo '<div class="flex flex-col flex-grow pl-2 space-y-1 justify-center ">';

                  // name of the user
                  echo '<div>';
                  echo '<p class="font-bold text-white flex-grow pr-3 h-fit">' . $fetch_row["user_name"] . '</p>';
                  echo '</div>';

                  // marital status wala badge
                  echo '<div class="p-2 rounded-xl bg-gray-950 bg-opacity-50 text-white backdrop-blur-xl w-fit px-2 space-x-2 flex flex-row items-center justify-center shadow-2xl">';
                  if (strtoupper($row['m_status']) === 'SINGLE') {
                    echo '<div class="mr-2">👀</div>';
                  } else {
                    echo '<div class="mr-2">💖</div>';
                  }
                  echo ucwords($row['m_status']);
                  echo '</div>';

                  echo '</div>';

                  echo '<div class="flex flex-col justify-center items-center">';
                  echo '<button class="mr-3 p-4 rounded-xl bg-opacity-50 bg-gray-950 text-white text-semibold h-fit hover:bg-opacity-100 transition transition-all duration-300">';
                  echo 'Add Friend';
                  echo '</button>';
                  // echo '<button class="group cursor-pointer outline-none hover:rotate-90 duration-300 flex flex-col justify-center pr-3"><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24" class="stroke-white fill-none group-hover:fill-green-800 group-active:stroke-white group-active:fill-zinc-600 group-active:duration-0 duration-300"><path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke-width="1.5"></path><path d="M8 12H16" stroke-width="1.5"></path><path d="M12 16V8" stroke-width="1.5"></path></svg></button>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</a>';

                }
              } else {
                echo '<div class="text-center flex-grow mt-20 text-2xl text-white font-semibold">';
                echo 'No users available';
                echo '</div>';
              }

              ?>
            </div>
          </div>

          <!-- SECOND BLOCK -->
          <div
            class="col-span-3 col-start-3 w-1/3 row-span-3 bg-gray-700 rounded-2xl shadow-2xl bg-opacity-60 transition ease-in-out transform duration-500 hover:scale-105 "
            style="backdrop-filter: blur(8px);">

            <!-- GHOST MODE BUTTON -->


          </div>
          <divs
            class="col-span-3 w-1/3 bg-gray-700 rounded-2xl bg-opacity-60 transition duration-500 ease-in-out transform hover:scale-105"
            style="backdrop-filter: blur(8px);">
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- SCRIPT TO HANDLE GHOST MODE TOGGLE -->
  <script>

  </script>

</body>

</html>
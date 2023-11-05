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

// query to fetch users to be displayed under available users
$sql = "SELECT * FROM details  WHERE user_email != '$uid' AND gender != '$gender'";
$result = $conn->query($sql);


// this code to make that phenomenal background
$details = mysqli_query($conn, "SELECT * FROM `details` WHERE user_email = '$uid'");
$detail_rows = mysqli_fetch_array($details, MYSQLI_ASSOC);
$profile_picture = $detail_rows['imgurl'];

?>

<!-- PHP ends here -->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- TailwindCSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <title><?php echo $name ?></title>
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


    /* Custom tooltip styles */
    .tooltip {
      position: relative;
    }

    .tooltip .tooltiptext {
      visibility: hidden;
      width: 300px;
      background-color: #000000d9;
      color: #fff;
      text-align: center;
      border-radius: 0.25rem;
      padding: 0.25rem;
      margin-bottom: 1rem;
      position: absolute;
      z-index: 10;
      bottom: 100%;
      left: 50%;
      transform: translateX(-50%);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .tooltip:hover .tooltiptext {
      visibility: visible;
      opacity: 1;
    }
  </style>
</head>

<body>
  <div class="bg-cover bg-center overflow-hidden h-screen w-screen backdrop-blur-2xl"
    style="background-image: url('<?php echo $profile_picture ?>');">
    <div class="flex justify-between h-full py-3">

      <!-- nav -->
      <?php include '../../modules/partials/nav.php' ?>

      <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
        <div class="col-span-9 row-span-3 pr-4 rounded-xl">
          <div
            class="flex flex-row w-full h-full bg-gray-950 bg-opacity-20 shadow-2xl rounded-xl p-4 backdrop-blur-2xl">
            <div class="w-full h-full rounded-xl flex flex-row space-x-4">
              <div class="w-1/3 h-full bg-gray-300 rounded-xl overflow-hidden shadow-xl">
                <img src="<?php echo $pfp; ?>" alt="Profile picture"
                  class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
              </div>
              <div class="w-2/3 h-full rounded-xl flex flex-col space-y-4">

                <!-- displayed the name of the user logged in with the greeting -->
                <div
                  class="bg-gray-950 bg-opacity-20 text-white p-2 w-full h-1/3 rounded-xl flex justify-center items-center backdrop-blur-3xl">
                  <h1 class="font-sans font-thin font-semibold text-4xl text-center">Hi!
                    <span class="font-semibold">
                      <?php echo $name; ?>
                    </span>
                  </h1>
                </div>

                <!-- displays the biodata of the currently logged in user -->
                <div
                  class="bg-gray-950 bg-opacity-20 text-white p-2 w-full h-2/3 font-thin rounded-xl backdrop-blur-3xl">
                  <h3 class="text-xl text-center">Bio</h3>
                  <div class="text-center text-2xl font-semibold mt-5 px-5">
                    <?php echo $biodat; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 3 BLOCKS -->
        <div class="flex flex-row gap-4 pb-0 pr-4 col-span-9 row-span-4 row-start-4">

          <!-- FIRST BLOCK -->
          <div
            class="overflow-hidden flex flex-col col-span-3 w-1/3 row-span-3 bg-gray-950 rounded-2xl shadow-2xl bg-opacity-10 transition ease-in-out transform duration-500 hover:scale-105 backdrop-blur-2xl">
            <?php include 'block1.php'; ?>
          </div>

          <!-- SECOND BLOCK -->
          <div
            class="tooltip col-span-3 col-start-3 w-1/3 row-span-3 bg-gray-950 rounded-2xl shadow-2xl bg-opacity-10 transition ease-in-out transform duration-500 hover:scale-105 backdrop-blur-2xl  shadow-2xl">
            <?php
            // if user is in matched show the profile of the other partner else show the other code
            $checkInMatched = mysqli_query($conn, "SELECT * FROM `matched_pairs` WHERE user1 = '$uid'");
            $numMatched = mysqli_num_rows($checkInMatched);

            if ($numMatched > 0) {
              include 'show_match.php';
            } else {
              include 'show_requests.php';
            }
            ?>
          </div>

          <!-- THIRD BLOCK -->
          <div
            class="col-span-3 w-1/3 bg-gray-950 rounded-2xl bg-opacity-10 transition duration-500 ease-in-out transform hover:scale-105  backdrop-blur-2xl shadow-2xl overflow-hidden">
            <?php 
              include 'block3.php';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT TO HANDLE ACCEPT DECLINES-->
  <script>
    function handleRequestAction(buttonElement, action) {
      const requestId = buttonElement.getAttribute('data-request-id');
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'update_request.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      const data = 'request_id=' + requestId + '&action=' + action;

      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          location.reload();
        }
      };

      xhr.send(data);

    }

    document.addEventListener('click', function (event) {
      if (event.target.classList.contains('accept-button')) {
        handleRequestAction(event.target, 'accept');
      } else if (event.target.classList.contains('reject-button')) {
        handleRequestAction(event.target, 'reject');
      }
    });

  </script>

</body>

</html>
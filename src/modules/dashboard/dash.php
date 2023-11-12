<?php
@include '../config.php';
session_start();

if (!isset($_SESSION['user_email'])) {
  header('location:../authentication/login.php');
}

// fetching the details of the user that is current logged into be displayed on the dashboard
$uid = $_SESSION['user_email'];
$result = mysqli_query($conn, "SELECT * FROM `details` WHERE user_email = '$uid'");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$pfp = $row['imgurl'];
$name = $_SESSION['user_name'];
$biodat = $row['bio'];
$gender = $row['gender'];

// MBTI Parameters
$EI = $row['EI'];
$SN = $row['SN'];
$TF = $row['TF'];
$JP = $row['JP'];

$_SESSION['pfp'] = $pfp;

// query to fetch users to be displayed under available users
$sql = "SELECT * FROM details  WHERE user_email != '$uid' AND gender != '$gender' ";
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

  <!-- sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>

  <!-- swal themes -->
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


  <!-- Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

  <title>
    <?php echo $name ?>
  </title>
  <link rel="icon" type="image/x-icon" href="../../images/dashboard/favicon.ico">

  <link rel="stylesheet" href="./css/styles.css">

  <style>
    * {
      font-family: 'Gentium Book Plus', serif;
    }

    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }

    .scrollbar-hide {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>

<body>
  <div class="bg-cover bg-center overflow-hidden h-screen w-screen backdrop-blur-2xl" style="background-image: url('<?php echo $profile_picture ?>');">
    <div class="flex justify-between h-full py-3">

      <!-- nav -->
      <?php include '../../modules/partials/nav.php' ?>

      <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
        <div class="col-span-9 row-span-3 pr-4 rounded-xl">
          <div class="flex flex-row w-full h-full bg-gray-950 bg-opacity-20 shadow-2xl rounded-xl p-4 backdrop-blur-2xl">
            <div class="w-full h-full rounded-xl flex flex-row space-x-4">
              <div id="pfpDisplay" class="w-1/3 h-full bg-gray-300 rounded-xl overflow-hidden shadow-xl">
                <img src="<?php echo $pfp; ?>" alt="Profile picture" class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
              </div>
              <div class="w-2/3 h-full rounded-xl flex flex-col space-y-4">

                <!-- displayed the name of the user logged in with the greeting -->
                <div class="bg-gray-950 bg-opacity-20 text-white p-2 w-full h-1/3 scrollbar-hide rounded-xl flex justify-center items-center backdrop-blur-3xl">
                  <h1 class="font-sans ont-semibold text-4xl text-center">Hi!
                    <span class="font-semibold">
                      <?php echo $name; ?>
                    </span>
                  </h1>
                </div>

                <!-- Display the biodata of the currently logged in user -->
                <div class="bg-gray-950 bg-opacity-20 text-white p-4 w-full h-2/3 font-thin rounded-xl backdrop-blur-3xl overflow-y-auto scrollbar-hide">
                  <!-- Display bio, but hide it initially -->
                  <div id="bioDisplay" class="text-center flex flex-col space-y-2 items-center justify-center scrollbar-hide overflow-y-auto scrollbar-hide">
                    <div class="text-center text-2xl italic font-base overflow-y-auto">
                      <?php echo $biodat; ?>
                    </div>
                  </div>
                  <div class="w-full h-fit flex flex-row space-x-2">
                    <div class="justify-center mr-5 w-1/2 bg-opacity-0" id="edit-bio-btn-div2">
                      <div class="p-4 mt-2 text-center bg-gray-300 font-semibold bg-opacity-50 backdrop-blur-2xl rounded-2xl shadow-2xl text-gray-950 w-full" id="edit-bio-btn-div"><button id="editBioButton" class="" onclick="editBio()">Edit bio</button></div><br>
                    </div>
                    <div class="justify-center mr-5 w-1/2 bg-opacity-0" id="edit-pfp-btn-div2">
                      <div class="p-4 mt-2 text-center bg-gray-300 font-semibold bg-opacity-50 backdrop-blur-2xl rounded-2xl shadow-2xl text-gray-950 w-full" id="edit-pfp-btn-div">
                        <button id="editpfpButton" class="" onclick="changepfp()">Edit profile pic</button>
                      </div>
                    </div>
                  </div>


                  <!-- Editable text area, hidden initially -->
                  <div class="flex-col items-center hidden justify-center w-full h-full" id="edit-bio-flex">
                    <div class="text-gray-950 text-center italic font-base text-2xl bg-opacity-20 w-full h-3/4 rounded-xl shadow-xl bg-gray-950 overflow-hidden">
                      <textarea id="bioEdit" class="hidden w-full h-full bg-opacity-50 bg-gray-100 backdrop-blur-2xl shadow-2xl p-4 focus:outline-none italic" rows="7 "><?php echo $biodat; ?></textarea>
                    </div>
                    <div class="p-4 py-2 mt-3 bg-gray-300 font-semibold bg-opacity-50 backdrop-blur-2xl rounded-2xl shadow-2xl italic text-gray-950 w-fit">
                      <button id="saveBioButton" class="hidden h-1/4" onclick="saveBio()">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 3 BLOCKS -->
        <div class="flex flex-row gap-4 pb-0 pr-4 col-span-9 row-span-4 row-start-4">

          <!-- FIRST BLOCK -->
          <div class="overflow-hidden flex flex-col col-span-3 w-1/3 row-span-3 bg-gray-950 rounded-2xl shadow-2xl bg-opacity-10 transition ease-in-out transform duration-500 hover:scale-105 backdrop-blur-2xl">
            <?php include './blocks/block1.php'; ?>
          </div>

          <!-- SECOND BLOCK -->
          <div class="tooltip col-span-3 col-start-3 w-1/3 row-span-3 bg-gray-950 rounded-2xl bg-opacity-10 transition ease-in-out transform duration-500 hover:scale-105 backdrop-blur-2xl  shadow-2xl">
            <?php
            // if user is in matched show the profile of the other partner else show the other text
            $checkInMatched = mysqli_query($conn, "SELECT * FROM `matched_pairs` WHERE user1 = '$uid'");
            $numMatched = mysqli_num_rows($checkInMatched);

            // Cursed piece of code right here
            if ($numMatched > 0) {
              include 'show_match.php';
            } else {
              include 'show_requests.php';
            }
            ?>
          </div>

          <!-- THIRD BLOCK -->
          <div class="col-span-3 w-1/3 bg-gray-950 rounded-2xl bg-opacity-10 transition duration-500 ease-in-out transform hover:scale-105  backdrop-blur-2xl shadow-2xl overflow-hidden">
            <?php
            include './blocks/block3.php';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT TO HANDLE ACCEPT DECLINES-->
  <script src="./js/script.js"></script>

</body>

</html>
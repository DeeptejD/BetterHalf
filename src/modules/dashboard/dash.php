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

$sql = "SELECT * FROM details ";
$result = $conn->query($sql);
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

    <!-- nav -->
      <?php include '../../modules/partials/nav.php' ?>
      
      <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
        <div class="col-span-9 row-span-3 pr-4 rounded-xl">
          <div class="flex flex-row w-full h-full bg-gray-900 bg-opacity-50 shadow-2xl rounded-xl p-4" style="backdrop-filter: blur(8px);">
            <div class="w-full h-full rounded-xl flex flex-row space-x-4">
              <div class="w-1/3 h-full bg-gray-300 rounded-xl overflow-hidden shadow-xl">
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
              <div>
                <h1 class='font-sans mt-2  text-4xl text-center text-white'>Available:</h1>
              <?php
              if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="flex  bg-white border-black m-4 bg-opacity-20 rounded-xl">';
                    echo '<img src="' . $row['imgurl'] . '" alt="Profile Picture" class="object-cover rounded-full shadow-xl h-16 w-16 m-2">';
                    echo '<p class="text-center ml-4 mt-6 font-thin text-white">' . $row["bio"] . '</p>';
                    echo '<button class="group cursor-pointer outline-none hover:rotate-90 duration-300 "><svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24" class="stroke-zinc-400 fill-none group-hover:fill-zinc-800 group-active:stroke-zinc-200 group-active:fill-zinc-600 group-active:duration-0 duration-300"><path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke-width="1.5"></path><path d="M8 12H16" stroke-width="1.5"></path><path d="M12 16V8" stroke-width="1.5"></path></svg></button>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            
            ?>
           </div>
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
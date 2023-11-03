<?php
session_start();
include_once "../config.php";
if (!isset($_SESSION['user_email'])) {
  header("location: ../authentication/login.php");
}
$uid = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM `details` WHERE user_id = '$uid'");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$pfp = $row['imgurl'];
?>

<!-- PHP END HTML STARTS -->

<?php include_once "header.php"; ?>
<link rel="icon" type="image/x-icon" href="../../images/chat/favicon.ico">

<body class="">
  <div class="bg-cover bg-center overflow-hidden h-screen w-screen "
    style="background-image: url('../../images/dashboard/background.jpg');">
    <div class="flex flex-row h-full py-3">

      <!-- nav -->
      <?php include '../../modules/partials/nav.php' ?>

      <!-- chat part -->
      <div class="wrapper mr-4 bg-opacity-20 bg-gray-950 shadow-2xl backdrop-blur-xl">
        <section class="users">
          <header>
            <div class="content">
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM register WHERE user_email = '{$_SESSION['user_email']}'");
              if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
              }
              ?>
              <a href="../dashboard/dash.php">
                <div class="details">
                  <span class="flex flex-row space-x-0">
                    <div class="rounded-l-xl shadow-2xl"><img src="<?php echo $pfp; ?>" alt="Profile Picture"
                        class="shadow-2xl rounded-l-xl"></div>
                    <div
                      class="flex flex-col justify-center items-center bg-gray-100 px-4 bg-opacity-20 backdrop-blur-xl rounded-r-xl shadow-2xl text-white font-semibold">
                      <?php echo $row['user_name'] ?>
                    </div>
                  </span>
                </div>
              </a>
            </div>
            <div
              class="p-2 rounded-xl bg-gray-100 bg-opacity-20 backdrop-blur-xl w-fit px-2 space-x-2 mt-2 flex flex-row items-center justify-center">
              <div class="<?php echo $row['status'] === 'Online' ? 'w-2 h-2 rounded-full bg-green-500' : 'w-2 h-2 rounded-full bg-red-500'; ?>"></div>              <div>
                <?php echo $row['status']; ?>
              </div>
            </div>
            <!-- <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a> -->
          </header>

          <!-- this is the search bar -->
          <div class="search bg-gray-100 rounded-md bg-opacity-30 backdrop-blur-xl">
            <span class="text text-white pl-6">Search</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search "></i></button>
          </div>

          <!-- this is the users list, users are fetched and put into this list -->
          <div class="users-list">

          </div>
        </section>
      </div>

      <script src="javascript/users.js"></script>

    </div>
  </div>
  </div>
  </div>
</body>

</html>
<?php
session_start();
include_once "../config.php";
if (!isset($_SESSION['user_email'])) {
  header("location: ../authentication/login.php");
}
$uid = $_SESSION['user_email'];
$result = mysqli_query($conn, "SELECT * FROM `details` WHERE user_email = '$uid'");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$pfp = $row['imgurl'];

?>

<?php include_once "header.php"; ?>
<link rel="icon" type="image/x-icon" href="../../images/chat/favicon.ico">

<body class="">
  <div class="bg-cover bg-center overflow-hidden h-screen w-screen"
    style="background-image: url('<?php echo $pfp ?>');">
    <div class="flex flex-row h-full py-3">

      <!-- nav -->
      <?php include '../../modules/partials/nav.php' ?>

      <!-- chat part -->
      <div class="wrapper flex flex-col items-center justify-center bg-opacity-50 backdrop-blur-xl mr-4">
        <section class="chat-area w-full h-full flex flex-col">
          <header class="bg-gray-950 rounded-t-2xl bg-opacity-40 text-white backdrop-blur-xl">
            <?php
            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            $sql = mysqli_query($conn, "SELECT * FROM register WHERE user_email = '{$user_id}'");
            if (mysqli_num_rows($sql) > 0) {
              $row = mysqli_fetch_assoc($sql);
            } else {
              header("location: users.php");
            }
            ?>

            <a href="users.php" class="back-icon"><i class="fas fa-arrow-left text-white"></i></a>
            <div class="flex flex-row items-center justify-center">
              <img src="<?php echo $pfp; ?>" alt="" class="rounded-xl ">
              <div class="details flex flex-row space-x-3 items-center justify-center">
                <span class="font-4xl">
                  <?php echo $row['user_name'] ?>
                </span>
                <div
                  class="p-2 rounded-xl bg-gray-100 bg-opacity-20 backdrop-blur-xl w-fit px-2 space-x-2 flex flex-row items-center justify-center">
                  
                  <!-- chooses whether to show a green or a white dot based on status -->
                  <div
                    class="<?php echo $row['status'] === 'Online' ? 'w-2 h-2 rounded-full bg-green-500' : 'w-2 h-2 rounded-full bg-red-500'; ?>">
                  </div>
                  <div>
                    <?php echo $row['status']; ?>
                  </div>
                </div>
              </div>
            </div>
          </header>
          <div class="chat-box bg-opacity-20 backdrop-blur-xl bg-gray-950 flex-grow">

          </div>
          <form action="#" class="typing-area bg-gray-950 bg-opacity-40 text-white backdrop-blur-xl ">
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
            <input type="text" name="message" class="input-field text-gray-950" placeholder="Type a message here..."
              autocomplete="off">
            <button><i class="fab fa-telegram-plane"></i></button>
          </form>
        </section>
      </div>

      <script src="javascript/chat.js"></script>

    </div>
  </div>
  </div>
  </div>
</body>

</html>
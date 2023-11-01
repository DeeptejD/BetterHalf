<?php 
  session_start();
  include_once "../config.php";
  if(!isset($_SESSION['user_email'])){
    header("location: ../authentication/login.php");
  }
  $uid = $_SESSION['user_id'];
  $result = mysqli_query($conn, "SELECT * FROM `details` WHERE user_id = '$uid'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $pfp = $row['imgurl'];

?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM register WHERE user_email = '{$user_id}'");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>

        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $pfp; ?>" alt="">
        <div class="details">
          <span><?php echo $row['user_name'] ?></span>
          <!-- <p><?php echo $row['status']; ?></p> -->
          <p>Online</p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>

<div class="w-full h-full rounded-2xl shadow-2xl flex flex-col space-y-2 p-4 overflow-hidden overflow-y-auto scrollbar-hide">

    <!-- show education details fetched from the db -->
    <!-- <div class="w-full h-1/4">
        <?php
        // $uid = $_SESSION['user_email'];
        // $query = "SELECT * FROM `details` WHERE `user_email` = '$uid'";
        // $result = mysqli_query($conn, $query);
        // $row = mysqli_fetch_assoc($result);
        // echo '<p class="text-2xl font-semibold text-gray-20">Bio</p>';
        // echo '<p class="text-xl font-normal text-gray-20">' . $row['bio'] . '</p>';
        ?>
    </div>   -->

    <a href="./edit/deleteAccount.php" class="w-full h-1/4">
        <?php
        echo '<button class="w-full shadow-2xl mr-3 p-4 rounded-xl bg-opacity-30 bg-red-300 hover:bg-red-500 text-2xl font-normal transition duration-500 ease-in-out transform hover:scale-105 text-gray-20 text-semibold h-full hover:bg-opacity-100 transition transition-all duration-300 backdrop-blur-2xl">';
        echo 'Delete Account';
        echo '</button>';
        ?>
    </a>

</div>
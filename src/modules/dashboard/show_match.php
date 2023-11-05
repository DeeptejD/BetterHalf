<?php

$matched_rows = mysqli_fetch_array($checkInMatched, MYSQLI_ASSOC);
$matched_user = $matched_rows['user2'];

$fetch_matched_user = mysqli_query($conn, "SELECT * FROM `details` WHERE user_email = '$matched_user'");
$matched_user_row = mysqli_fetch_array($fetch_matched_user, MYSQLI_ASSOC);
$matched_user_image = $matched_user_row['imgurl'];

$fetch_matched_user_name = mysqli_query($conn, "SELECT * FROM `register` WHERE user_email = '$matched_user'");
$matched_user_name_row = mysqli_fetch_array($fetch_matched_user_name, MYSQLI_ASSOC);
$matched_user_name = $matched_user_name_row['user_name'];

echo '<div class="flex flex-col w-full h-full p-4 pt-0">';

echo '<div class="w-full h-1/4">';
echo '<p class="font-base text-white flex-grow pr-3 h-fit text-2xl text-center mt-5">Your Match</p>';
echo '</div>';

echo '<div class="w-full h-3/4 flex flex-col transform transition transition-all duration-500 hover:-translate-y-1 hover:translate-x-1 items-center justify-center bg-gray-200 bg-opacity-20 rounded-xl bg-cover bg-center backdrop-blur-3xl shadow-2xl">';
echo '<a href="../profile/user_profile.php?current_user_email=' . $matched_user . '">';
echo '<div class="">';
echo '<img src="' . $matched_user_image . '" alt="Profile Picture" class=" object-cover rounded-lg shadow-2xl h-28 w-28 m-2">';
echo '</div>';

echo '<div>';
echo '<p class="font-md text-white flex-grow pr-3 h-fit text-2xl">' . $matched_user_name . '</p>';
echo '</div>';
echo '</a>';
echo '</div>';
echo '</div>';
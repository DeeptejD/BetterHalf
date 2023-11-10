<!-- heading -->
<div class="w-full h-fit ">
    <h1 class='font-sans text-2xl text-center text-white mt-5'>Discover</h1>
</div>

<!-- vertically scrollable div -->
<div class="w-full h-full overflow-y-auto overflow-x-hidden scrollbar-hide">

    <!-- php code to fetch users -->
    <?php
    if ($result->num_rows > 0) {
        $users_array = array();

        while ($row = $result->fetch_assoc()) {

            $mbti_score = 0;

            if ($EI == $row['EI']) $mbti_score += 25;
            if ($SN == $row['SN']) $mbti_score += 25;
            if ($TF == $row['TF']) $mbti_score += 25;
            if ($JP == $row['JP']) $mbti_score += 25;

            $row['mbti_score'] = $mbti_score;
            $users_array[] = [
                'email' => $row['user_email'],
                'mbti_score' => $mbti_score,
                'imgurl' => $row['imgurl'],
                'm_status' => $row['m_status']
            ];
        }

        usort($users_array, function ($a, $b) {
            return $b['mbti_score'] - $a['mbti_score'];
        });

        foreach ($users_array as $user) {

            $current_email = $user['email'];

            echo '<a href="../profile/user_profile.php?current_user_email=' . $current_email . '">';
            echo '<div class="w-full h-fit transform transition-all duration-500 hover:-translate-y-1 hover:translate-x-1">';

            // profile image
            echo '<div class="flex bg-gray-200 m-3 p-2 bg-opacity-20 rounded-xl bg-cover bg-center backdrop-blur-3xl shadow-2xl">';
            echo '<img src="' . $user['imgurl'] . '" alt="Profile Picture" class="object-cover rounded-lg shadow-xl h-16 w-16 m-2">';

            // fetching the name of the user to be displayed


            $fetch_sql = "SELECT * FROM `register` WHERE user_email = '$current_email'";
            $fetch_result = $conn->query($fetch_sql);
            $fetch_row = $fetch_result->fetch_assoc();

            echo '<div class="flex flex-col flex-grow pl-2 space-y-1 justify-center ">';

            // name of the user
            echo '<div>';
            echo '<p class="font-bold text-white flex-grow pr-3 h-fit">' . $fetch_row["user_name"] . '</p>';
            echo '</div>';

            // badges
            echo '<div class="pl-4 pr-4 rounded-xl bg-opacity-50 text-white backdrop-blur-xl w-fit px-2 space-x-2 flex flex-row items-center justify-center shadow-2xl">';
            echo ucwords($user['m_status']);
            echo '</div>';

            if ($user['mbti_score'] == 100)
            {
            echo '<div class="pl-4 pr-4 rounded-xl bg-opacity-100 bg-gradient-to-r from-purple-500 via-purple-600 to-pink-500 text-white backdrop-blur-xl w-fit px-2 space-x-2 flex flex-row items-center justify-center shadow-2xl">';
            echo 'Perfect Match!';
            echo '</div>';
            }

            echo '<div class="pl-4 pr-4 rounded-xl bg-opacity-100';
            if ($user['mbti_score'] >= 75) 
            echo ' bg-green-700 ';
            else if ($user['mbti_score']>=50) echo ' bg-yellow-500 ';
            else
            echo ' bg-orange-400 ';
            echo 'text-white backdrop-blur-xl w-fit px-2 space-x-2 flex flex-row items-center justify-center shadow-2xl">';
            echo $user['mbti_score'] . '% Match';
            echo '</div>';

            echo '</div>';

            echo '<div class="flex flex-col justify-center items-center">';
            echo '<button title="Add As Friend"class="group cursor-pointer outline-none hover:rotate-90 duration-300">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24" class="stroke-white fill-none group-hover: group-active:stroke-zinc-200 group-active:fill-zinc-600 group-active:duration-0 duration-300">';
            echo '<path
            d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
            stroke-width="1.5"
          >';
            echo '</path>';
            echo '<path d="M8 12H16" stroke-width="1.5"></path>';
            echo '<path d="M12 16V8" stroke-width="1.5"></path>';
            echo '</svg>';
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
<span class="tooltiptext absolute text-sm bg-gray-950 text-white p-1 rounded-md">Interest Requests
    contain people who are interested to be commited in a relationship with you. Accepting one will change
    your status to commited with that person</span>

<div class="w-full h-full overflow-y-auto flex flex-col space-y-2 scrollbar-hide">
    <div class="w-full h-fit ">
        <h1 class='font-sans mt-2 text-2xl text-center text-white mt-5'>Interest Requests</h1>
    </div>

    <!-- vertically scrollable div to show requests -->
    <div class="w-full h-full overflow-y-auto overflow-x-hidden scrollbar-hide">
        <?php

        // fetches interest requests
        $fetch_requests = "SELECT * FROM `interest_requests` WHERE receiver_id = '$uid'";
        $fetch_result = $conn->query($fetch_requests);

        if ($fetch_result->num_rows > 0) {
            while ($row = $fetch_result->fetch_assoc()) {
                $sender_id = $row['sender_id'];
                $request_id = $row['request_id'];
                $fetch_sender = "SELECT * FROM `details` WHERE user_email = '$sender_id'";
                $fetch_sender_result = $conn->query($fetch_sender);
                $fetch_sender_row = $fetch_sender_result->fetch_assoc();

                echo '<a href="../profile/user_profile.php?current_user_email=' . $sender_id . '">';
                echo '<div class="w-full transform transition transition-all duration-500 hover:-translate-y-1 hover:translate-x-1">';

                // profile image
                echo '<div class="flex bg-white m-3 p-2 bg-opacity-30 rounded-xl bg-cover bg-center ">';
                echo '<img src="' . $fetch_sender_row['imgurl'] . '" alt="Profile Picture" class="object-cover rounded-lg shadow-xl h-16 w-16 m-2">';

                // fetching the name of the user to be displayed
                echo '<div class="flex flex-col flex-grow pl-2 h-full justify-center mt-1 space-y-1 justify-center ">';

                // name of the user
        
                $fetch_sender_name = "SELECT * FROM `register` WHERE user_email = '$sender_id'";
                $fetch_sender_name_result = $conn->query($fetch_sender_name);
                $fetch_sender_name_row = $fetch_sender_name_result->fetch_assoc();

                echo '<div>';
                echo '<p class="font-bold text-white flex-grow pr-3 h-fit">' . $fetch_sender_name_row["user_name"] . '</p>';
                echo '</div>';

                // marital status wala badge
                echo '<div class="p-2 rounded-xl bg-gray-950 bg-opacity-50 text-white backdrop-blur-xl w-fit px-2 space-x-2 flex flex-row items-center justify-center shadow-2xl">';
                if (strtoupper($fetch_sender_row['m_status']) === 'SINGLE') {
                    echo '<div class="mr-2">👀</div>';
                } else {
                    echo '<div class="mr-2">💖</div>';
                }
                echo ucwords($fetch_sender_row['m_status']);
                echo '</div>';

                echo '</div>';

                echo '<div class="flex flex-row justify-center items-center space-x-1">';
                echo '<button class="accept-button shadow-2xl p-4 rounded-xl bg-opacity-50 bg-lime-400 text-black font-semibold h-fit hover:bg-opacity-100 transition transition-all duration-300" data-request-id="' . $request_id . '">';
                echo 'Accept';
                echo '</button>';
                echo '<button class="reject-button shadow-2xl p-4 rounded-xl bg-opacity-50 bg-red-800 text-white font-semibold h-fit hover:bg-opacity-100 transition transition-all duration-300" data-request-id="' . $request_id . '">';
                echo 'Reject';
                echo '</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</a>';

            }
        } else {

            echo '<div class="text-center font-sembold text-white flex-grow mt-20 text-2xl">';
            echo 'No requests available';
            echo '</div>';

        }
        ?>
    </div>
</div>
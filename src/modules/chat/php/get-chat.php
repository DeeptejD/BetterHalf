<?php
include_once "../../config.php";
session_start();
if (isset($_SESSION['user_email'])){
    $outgoing_id = $_SESSION['user_email'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN register ON register.user_id = messages.outgoing_msg_id
        WHERE (outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}')
        OR (outgoing_msg_id = '{$incoming_id}' AND incoming_msg_id = '{$outgoing_id}') ORDER BY msg_id";

    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="https://images.pexels.com/photos/4588052/pexels-photo-4588052.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../../authentication/login.php");
}

?>
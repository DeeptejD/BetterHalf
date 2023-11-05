<?php
@include '../config.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header('location:../authentication/login.php');
}

// fetching the details of the user that is current logged in
// to be displayed on the dashboard
$uid = $_SESSION['user_email'];
$result = mysqli_query($conn, "SELECT * FROM `details` WHERE user_email = '$uid'");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$pfp = $row['imgurl'];
$name = $_SESSION['user_name'];
$biodat = $row['bio'];
$gender = $row['gender'];
// if (isset($_POST['submit'])) {
//   session_destroy();
//   header('location:../authentication/login.php');
// }

// query to fetch users to be displayed under available users
$sql = "SELECT * FROM details  WHERE user_email != '$uid' AND gender != '$gender'";
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
    <!-- <link rel="stylesheet" href="../../build/css/tailwind.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $pfp ?>">



    <style>
        /* For Webkit-based browsers (Chrome, Safari and Opera) */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* For IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }


        /* Custom tooltip styles */
        .tooltip {
            position: relative;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 300px;
            background-color: #000000d9;
            color: #fff;
            text-align: center;
            border-radius: 0.25rem;
            padding: 0.25rem;
            margin-bottom: 1rem;
            position: absolute;
            z-index: 10;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen backdrop-blur-2xl"
        style="background-image: url('<?php echo $profile_picture ?>');">
        <div class="flex justify-between h-full py-3">

            <!-- nav -->
            <?php include '../../modules/partials/nav.php' ?>

            <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
                <div class="col-span-9 row-span-5 pr-4 rounded-xl backdrop-blur-2xl mr-4 shadow-2xl">

                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT TO HANDLE ACCEPT DECLINES-->
    <script>
        function handleRequestAction(buttonElement, action) {
            const requestId = buttonElement.getAttribute('data-request-id');
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_request.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            const data = 'request_id=' + requestId + '&action=' + action;

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };

            xhr.send(data);

        }

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('accept-button')) {
                handleRequestAction(event.target, 'accept');
            } else if (event.target.classList.contains('reject-button')) {
                handleRequestAction(event.target, 'reject');
            }
        });

    </script>

</body>

</html>
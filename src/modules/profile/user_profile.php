<?php
@include '../config.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header('location:../authentication/login.php');
}

// fetch which user to display
if (isset($_GET['current_user_email']))
    $userEmail = urldecode($_GET['current_user_email']);
else
    header('location: ../dashboard/dash.php');

// fetching the details of the user that is current to be shown
$details = mysqli_query($conn, "SELECT * FROM `details` WHERE user_email = '$userEmail'");
$detail_rows = mysqli_fetch_array($details, MYSQLI_ASSOC);

$profile_picture = $detail_rows['imgurl'];
$user_bio = $detail_rows['bio'];
$user_marital_status = $detail_rows['m_status'];
$user_religion = $detail_rows['Religion'];
$user_gender = $detail_rows['gender'];
$user_age = $detail_rows['Age'];
$user_DOB = $detail_rows['DOB'];

$register = mysqli_query($conn, "SELECT * FROM `register` WHERE user_email = '$userEmail'");
$register_rows = mysqli_fetch_array($register, MYSQLI_ASSOC);

$user_name = $register_rows['user_name'];

?>

<!-- PHP ends here -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <title>User Profile</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $profile_picture ?>">

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <!-- swal themes -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

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
    </style>
</head>

<body>
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen"
        style="background-image: url('<?php echo $profile_picture ?>');">
        <div class="flex justify-between h-full py-3">

            <!-- nav -->
            <?php include '../../modules/partials/nav.php' ?>

            <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
                <div
                    class="row-span-5 col-span-9 rounded-xl backdrop-blur-xl bg-gray-950 bg-opacity-50 mr-4 overflow-x-hidden overflow-y-auto scrollbar-hide">
                    <!-- to show the pfp -->
                    <div class="flex w-full flex-row items-center justify-center p-16 pb-10">
                        <div class="rounded-xl shadow-2xl bg-center bg-cover">
                            <img src="<?php echo $profile_picture; ?>" alt=""
                                class="rounded-xl shadow-2xl h-48 w-48 object-cover">
                        </div>
                    </div>

                    <!-- to show the name -->
                    <div class="flex flex-col items-center justify-center px-32 mx-16 border-b-2 mb-10 pb-7">

                        <!-- name -->
                        <div class="text-4xl text-white font-bold ">
                            <?php echo $user_name; ?>
                        </div>

                        <!-- bio -->
                        <div class="text-2xl text-white font-base mt-4 ">
                            <?php echo $user_bio; ?>
                        </div>

                        <!-- details -->
                        <div class="flex flex-row flex-wrap space-x-4 ">

                            <!-- marital status card -->
                            <div
                                class="hover:px-5 transition transition-all duration:300 p-2 mt-5 text-xl  rounded-xl bg-gray-950 text-white bg-opacity-50 backdrop-blur-xl w-fit px-3 space-x-2 flex flex-row items-center justify-center">
                                <?php
                                // if (strtoupper($user_marital_status) === 'SINGLE')
                                //     echo '👀';
                                // else
                                //     echo '💖'
                                        ?>
                                <?php echo $user_marital_status; ?>
                            </div>

                            <!-- gender card -->
                            <div
                                class="hover:px-5 transition transition-all duration:300 p-2 mt-5 text-xl  rounded-xl bg-gray-950 text-white bg-opacity-50 backdrop-blur-xl w-fit px-3 space-x-2 flex flex-row items-center justify-center">
                                <?php
                                // if (strtoupper($user_gender) === 'MALE')
                                //     echo '👨🏻';
                                // else
                                //     echo '👩🏻'
                                        ?>
                                <?php echo $user_gender; ?>
                            </div>

                            <!-- age card -->
                            <div
                                class="hover:px-5 transition transition-all duration:300 p-2 mt-5 text-xl  rounded-xl bg-gray-950 text-white bg-opacity-50 backdrop-blur-xl w-fit px-3 space-x-2 flex flex-row items-center justify-center">

                                <?php echo 'Age: ' . $user_age; ?>
                            </div>

                            <!-- religion card -->
                            <div
                                class="hover:px-5 transition transition-all duration:300 p-2 mt-5 text-xl  rounded-xl bg-gray-950 text-white bg-opacity-50 backdrop-blur-xl w-fit px-3 space-x-2 flex flex-row items-center justify-center">

                                <?php echo $user_religion; ?>
                            </div>

                            <!-- DOB card -->
                            <div
                                class=" hover:px-5 transition transition-all duration:300 p-2 mt-5 text-xl  rounded-xl bg-gray-950 text-white bg-opacity-50 backdrop-blur-xl w-fit px-3 space-x-2 flex flex-row items-center justify-center">

                                <?php echo $user_DOB; ?>

                            </div>
                        </div>

                    </div>

                    <!-- CTA buttons -->
                    <div class="flex flex-row space-x-5 items-center justify-center">
                        <?php
                        $sender_id = $_SESSION['user_email'];
                        $receiver_id = $userEmail;

                        // this button only shows up once u send a request
                        $check = mysqli_query($conn, "SELECT * FROM `interest_requests` WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id'");
                        $check_rows = mysqli_num_rows($check);
                        if (!($check_rows > 0)) {
                            echo '<div onclick="send_request()">';
                            echo '<button class="bg-pink-200 shadow-2xl text-gray-950 hover:px-16 transition transition-all text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-bold font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-pink-400 hover:text-gray-950 transition ease-in-out hover:shadow-2xl mb-14 bg-opacity-50 transform duration-300 hover:scale-105">';
                            echo 'Express Interest';
                            echo '</button>';
                            echo '</div>';
                        }
                        ?>
                        <div>
                            <button
                                class="bg-gray-500 shadow-2xl text-white hover:px-10 transition transition-all text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-semibold font-sans p-8 px-6 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl mb-14 bg-opacity-50 transform duration-300 hover:scale-105">
                                Add Friend
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function send_request() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "insert_interest_request.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "userEmail=" + encodeURIComponent("<?php echo $userEmail; ?>");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Interest Request sent to <?php echo $user_name; ?>',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    console.log("Error: " + xhr.status);
                }
            };
            xhr.send(data);

        }
    </script>
</body>

</html>
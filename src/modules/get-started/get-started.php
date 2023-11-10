<?php
@include '../config.php';
session_start();

$userid = $_SESSION['user_id'];

$userexists = mysqli_query($conn, "SELECT * FROM `details` WHERE user_id = '$userid'");

if (mysqli_num_rows($userexists) > 0) {
    header("location: ../dashboard/dash.php");
} else {
    if (isset($_SESSION['user_email'])) {
        if (isset($_POST['submit'])) {

            // Calculate MBTI Score
            $EI = $_POST['EI'];
            $SN = $_POST['SN'];
            $TF = $_POST['TF'];
            $JP = $_POST['JP'];

            // $mbti = $E . $S . $T . $J;


            $dob = $_POST['dob'];
            $user_email = $_SESSION['user_email'];
            $mstatus = $_POST['marital'];
            $gender = $_POST['gender'];
            $religion = $_POST['religion'];
            $caste = $_POST['caste'];

            // CALC AGE FROM BIRTH DATE
            $birthDate = new DateTime($dob);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthDate)->y;

            $imgname = $_FILES['image']['name'];
            $imgsize = $_FILES['image']['size'];
            $tmpname = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            // MBTI
            $bio = $_POST['bio'];
            $EI = $_POST['EI'];
            $SN = $_POST['SN'];
            $TF = $_POST['TF'];
            $JP = $_POST['JP'];

            if ($age <= 20) {

                // COCOMELON
                $targetLink = 'https://www.youtube.com/channel/UCbCmjCuTUZos6Inko4u57UQ';

                echo '<script>
                    window.location.href = "get-started.php";
                    alert("The legal minimum age mandatory for marriage in India is 21");
                </script>';

                header("location: $targetLink");
            }

            if ($error === 0) {
                if ($imgsize > 3000000) {
                    echo '<script> 
                        window.location.href = "get-started.php";
                        alert("Please insert a file with smaller size");
                    </script>';
                } else {
                    $img_ex = pathinfo($imgname, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg", "jpeg", "png");
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . "." . $img_ex_lc;
                        $img_upload_path = "../../../uploads/" . $new_img_name;
                        move_uploaded_file($tmpname, $img_upload_path);

                        $pdo = new PDO("mysql:host=localhost;dbname=loginpage", "root", "");

                        $insertquery = $pdo->prepare("INSERT INTO `details` (user_id, DOB, m_status, gender, Religion, Caste, Age, imgurl, bio, user_email, EI, SN, TF, JP) VALUES (:userid, :dob, :mstatus, :gender, :religion, :caste, :age, :img_upload_path, :bio, :user_email, :EI, :SN, :TF, :JP)");

                        $insertquery->bindParam(':userid', $userid);
                        $insertquery->bindParam(':dob', $dob);
                        $insertquery->bindParam(':mstatus', $mstatus);
                        $insertquery->bindParam(':gender', $gender);
                        $insertquery->bindParam(':religion', $religion);
                        $insertquery->bindParam(':caste', $caste);
                        $insertquery->bindParam(':age', $age);
                        $insertquery->bindParam(':img_upload_path', $img_upload_path);
                        $insertquery->bindParam(':bio', $bio);
                        $insertquery->bindParam(':user_email', $user_email);
                        $insertquery->bindParam(':EI', $EI);
                        $insertquery->bindParam(':SN', $SN);
                        $insertquery->bindParam(':TF', $TF);
                        $insertquery->bindParam(':JP', $JP);

                        if ($insertquery->execute()) {
                        } else {
                            $errorInfo = $insertquery->errorInfo();
                            echo "Error: " . $errorInfo[2];
                        }

                        header("location: ../dashboard/dash.php");
                    } else {
                        echo "incorrect file type";
                        echo '<script> 
                        window.location.href = "get-started.php";
                        alert("Please insert a valid file type!");
                    </script>';
                    }
                }
            } else {
                echo '<script> 
                    window.location.href = "";
                    alert("unknown error");
                </script>';
            }
        }
    } else {
        echo '<script>
            window.location.href = "../authentication/login.php";
            alert("Please login to continue with this page");
        </script>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <title>Get Started</title>
    <link rel="stylesheet" href="./css/basic.css" />
</head>

<body>
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen " style="background-image: url('../../images/dashboard/background.jpg');">
        <div class="min-h-screen flex items-center justify-center shadow-2xl">
            <div class="h-screen w-screen py-11 px-52">
                <div class="bg-gray-200 bg-opacity-25 bg-blur rounded-xl flex flex-row h-full w-full " style="backdrop-filter: blur(8px);">
                    <div class="bg-gray-900 rounded-l-xl w-1/3 h-full overflow-hidden">
                        <img src="../../images/get-started/the-gif.gif" alt="" class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
                    </div>
                    <div class="w-2/3 h-full p-4 rounded-r-xl">
                        <div class="space-y-1 p-5 flex flex-col justify-center items-center h-full">

                            <form action="" class="w-full py-6 px-2" enctype="multipart/form-data" method="post">
                                <?php
                                include './formParts/part1.php';
                                include './formParts/part2.php';
                                include './formParts/part3.php';
                                include './formParts/part4.php';
                                include './formParts/part5.php';
                                include './formParts/part6.php';
                                include './formParts/part7.php';
                                ?>
                            </form>

                            <script src="./js/getStarted.js"></script>
                            <script src="./js/showSteps.js"></script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
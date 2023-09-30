<?php
@include '../config.php';
session_start();
if(isset($_SESSION['user_email'])){
    if (isset($_POST['submit'])) {
        $userid = $_SESSION['user_id'];
        $dob = $_POST['dob'];
        $mstatus = $_POST['marital'];
        $gender = $_POST['gender'];
        $religion = $_POST['religion'];
        $caste = $_POST['caste'];
        $age = $_POST['age'];
        $imgname = $_FILES['image']['name'];
        $imgsize = $_FILES['image']['size'];
        $tmpname = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
        $bio = $_POST['bio'];
        if($error === 0){
            if($imgsize > 1250000){
                echo "crossed size limit";
                    echo '<script> 
                    window.location.href = "get-started.php";
                    alert("Please insert a file with smaller size");
                </script>';
            }
            else{
                $img_ex = pathinfo($imgname, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).".". $img_ex_lc;
                    $img_upload_path = "../../../uploads/". $new_img_name;
                    move_uploaded_file($tmpname, $img_upload_path);
                    $insertquery = "INSERT INTO `details`(`user_id`, `DOB`, `m_status`, `gender`, `Religion`, `Caste`, `Age`, `imgurl`, `bio`) VALUES ('$userid', '$dob', '$mstatus', '$gender', '$religion', '$caste', '$age', '$new_img_name', '$bio')";
                    mysqli_query($conn, $insertquery);
                    header("location: ../dashboard/dash.html");
                }
                else{
                    echo "incorrect file type";
                    echo '<script> 
                    window.location.href = "get-started.php";
                    alert("Please insert a valid file type!");
                </script>';
                }
            }
        }else{
            echo "unknown error occured";
                    echo    '<script> 
                                window.location.href = "";
                                alert("unknown error");
                            </script>';
        }
    }
}
else{
    echo "Please login to continue";
    echo '<script> 
                window.location.href = "../authentication/login.php";
                alert("Please login to continue with this page");
            </script>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link
        href="https://fonts.googleapis.com/css2?family=Inter&family=Merriweather:ital,wght@1,300&family=Playfair+Display&display=swap"
        rel="stylesheet"> -->

    <title>Get Started</title>

    <style>
        .part {
            display: none;
        }

        .part.active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen "
        style="background-image: url('../../images/dashboard/background-2.jpg');">
        <div class="min-h-screen flex items-center justify-center shadow-2xl">
            <div class="h-screen w-screen py-11 px-52">
                <div class="bg-gray-200 bg-opacity-25 bg-blur rounded-xl flex flex-row h-full w-full "
                    style="backdrop-filter: blur(8px);">
                    <div class="bg-gray-900 rounded-l-xl w-1/3 h-full overflow-hidden">
                        <img src="../../images/get-started/the-gif.gif" alt=""
                            class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
                    </div>
                    <!-- this was where there was the red color -->
                    <div class="w-2/3 h-full p-4 rounded-r-xl">
                        <div class="space-y-1 p-5 flex flex-col justify-center items-center h-full">
                            <form action="" class="w-full py-6 px-2" enctype="multipart/form-data" method="post">
                                <!-- Part-1 -->
                                <div class="part part-1 active" id="part-1">
                                    <h1 class="text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold pb-3 mb-6">
                                        Personal
                                        Information</h1>

                                    <div class="flex flex-row space-x-3">
                                        <!-- DOB -->
                                        <div class="pt-2">
                                            <label for="dob"
                                                class="text-gray-950 text-lg font-semibold shadow-2xl pl-2">Date of
                                                birth</label>
                                            <input type="date" name="dob" id="dob"
                                                class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 uppercase p-5 focus:outline-none">
                                        </div>

                                        <!-- Marital -->
                                        <div class="pt-2 ">
                                            <label for="marital"
                                                class="text-gray-950  text-lg font-semibold shadow-2xl pl-2">Marital
                                                Status</label>
                                            <select name="marital" id="marital"
                                                class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 p-5 appearance-none focus:outline-none">
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                            </select>
                                        </div>
                                        <!-- Gender -->
                                        <div class="pt-2">
                                            <label for="gender"
                                                class="text-gray-950  text-lg font-semibold shadow-2xl  pl-2">Select
                                                Gender</label>
                                            <select name="gender" id="gender"
                                                class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 p-5 appearance-none focus:outline-none">
                                                <option value="male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="nonBinary">Non Binary</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="flex flex-row space-x-3">
                                        <!-- Religion -->
                                        <div class="pt-2">
                                            <label for="religion"
                                                class="text-gray-950  text-lg font-semibold shadow-2xl pl-2">Religion</label>
                                            <select name="religion" id="religion"
                                                class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 p-5 appearance-none focus:outline-none"
                                                onchange="updateCasteOptions()">
                                                <option value="hindu">Hindu</option>
                                                <option value="muslim">Muslim</option>
                                                <option value="christian">Christian</option>
                                            </select>
                                        </div>

                                        <!-- Caste -->
                                        <div class="pt-2">
                                            <label for="caste"
                                                class="text-gray-950  text-lg font-semibold shadow-2xl pl-2">Caste</label>
                                            <select name="caste" id="caste"
                                                class="w-full rounded-2xl appearance-none shadow-2xl bg-gray-200 active:bg-gray-300 p-5 focus:outline-none">
                                                <option value="brahmin">Brahmin</option>
                                                <option value="kshatriya">Kshatriya</option>
                                                <option value="vaishya">Vaishya</option>
                                                <option value="shudra">Shudra</option>
                                                <option value="others-hindu">Others</option>
                                            </select>
                                        </div>

                                        <div class="pt-2">
                                            <label for="age"
                                                class="text-gray-950 text-lg font-semibold shadow-2xl pl-2">Age</label>
                                            <input type="number" name="age" id="age" min="18" max="100"
                                                class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 uppercase p-5 focus:outline-none">
                                        </div>

                                    </div>
                                    <div class="flex flex-row justify-end pt-7">
                                        <a href="#"
                                            class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110"
                                            onclick="showStepTwo()">Next</a>
                                    </div>
                                </div>

                                <!-- Part-2 -->
                                <div class="part part-2" id="part-2">
                                    <h1 class="text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold mb-6">
                                        Upload your Profile Picture</h1>
                                    <p class="text-gray-100 font-bold mb-6  pb-3">
                                        This is how people will identify you!</p>
                                    <div class="flex items-center justify-center w-full" id="input-field">
                                        <label for="dropzone-file"
                                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-300 border-gray-600">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-600" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <div class=" hover:text-gray-50">
                                                    <p class="mb-2 text-sm text-gray-500 "><span
                                                            class="font-semibold">Click to upload</span>
                                                        or drag and drop</p>
                                                    <p class="text-xs text-gray-500">PNG, JPG or JPEG
                                                        (MAX. 800x400px)</p>
                                                </div>
                                            </div>
                                            <input type="file" id="dropzone-file" name="image"  class="hidden"
                                                onchange="previewImage(this)" accept="image/*" />
                                        </label>
                                    </div>
                                    <!-- Displaying the uploaded profile picture -->
                                    <div class="flex justify-center items-center border-gray-700 ">
                                        <img id="profile-picture" name ="image" class="rounded-full h-32 w-32 object-cover hidden"
                                            src="" alt="Profile Picture" />
                                    </div>
                                    <div class="flex flex-row justify-between pt-7">
                                        <a href="#"
                                            class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110"
                                            onclick="showStepOne()">Previous</a>

                                        <a href="#" id="upload-another"
                                            class="focus:outline-none hidden w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110"
                                            onclick="showFileInput()">Change</a>

                                        <a href=" #"
                                            class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110"
                                            onclick="showStepThree()">Next</a>
                                    </div>
                                </div>

                                <!-- Part-3 -->
                                <div class="part part-3" id="part-3">
                                    <h1 class="text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold mb-6">
                                        Enter your bio</h1>
                                    <p class="text-gray-100 font-bold mb-6  pb-3">
                                        Write a snappy bio that defines YOU!</p>
                                    <textarea id="bio-input" name="bio" rows="4" cols="50" maxlength="500"
                                        placeholder="You really dont need more than a 50 words to write something catchy"
                                        class="w-full h-60 rounded-xl p-5 appearance-none"></textarea>
                                    <p id="bio-counter" class="text-gray-100 text-sm">Remaining words: 50</p>
                                    <div class="flex flex-row justify-between pt-7">
                                        <a href="#"
                                            class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110"
                                            onclick="showStepTwo()">Previous</a>


                                        <input type="submit" name="submit" id="submit" href=" #"
                                            class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110"/>
                                    </div>
                                </div>
                            </form>

                            <script>
                                function updateCasteOptions() {
                                    const religionSelect = document.getElementById("religion");
                                    const casteSelect = document.getElementById("caste");

                                    const selectedReligion = religionSelect.value;

                                    while (casteSelect.options.length > 0) {
                                        casteSelect.remove(0);
                                    }

                                    switch (selectedReligion) {
                                        case "hindu":
                                            casteSelect.add(new Option("Brahmin", "brahmin"));
                                            casteSelect.add(new Option("Kshatriya", "kshatriya"));
                                            casteSelect.add(new Option("Vaishya", "vaishya"));
                                            casteSelect.add(new Option("Shudra", "shudra"));
                                            casteSelect.add(new Option("Others", "hindu-others"));
                                            break;
                                        case "muslim":
                                            casteSelect.add(new Option("Sunni", "sunni"));
                                            casteSelect.add(new Option("Shia", "shia"));
                                            casteSelect.add(new Option("Others", "muslim-others"));
                                            break;
                                        case "christian":
                                            casteSelect.add(new Option("Catholic", "catholic"));
                                            casteSelect.add(new Option("Protestant", "protestant"));
                                            casteSelect.add(new Option("Others", "christian-others"));
                                            break;
                                        default:
                                            break;
                                    }
                                }

                                // script to change the profile picture
                                function previewImage(input) {
                                    if (input.files && input.files[0]) {
                                        const reader = new FileReader();

                                        reader.onload = function (e) {
                                            const profilePicture = document.getElementById('profile-picture');
                                            profilePicture.src = e.target.result;
                                            profilePicture.classList.remove('hidden');

                                            const inputfield = document.getElementById('input-field');
                                            inputfield.classList.add('hidden')

                                            const uploadAnotherButton = document.getElementById('upload-another');
                                            uploadAnotherButton.classList.remove('hidden')
                                        };

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                function showFileInput() {
                                    // show the input field
                                    const inputfield = document.getElementById('input-field');
                                    inputfield.classList.remove('hidden');

                                    // hide profile pic and change button
                                    const profilePicture = document.getElementById('profile-picture');
                                    profilePicture.classList.add('hidden');

                                    const uploadButton = document.getElementById('upload-button');
                                    uploadButton.classList.add('hidden');
                                }

                                function hideFileInput() {
                                    // hide input field
                                    const inputfield = document.getElementById('input-field');
                                    inputfield.classList.add('hidden');

                                    // show profile picture and change button
                                    const profilePicture = document.getElementById('profile-picture');
                                    profilePicture.classList.remove('hidden');

                                    const uploadButton = document.getElementById('upload-button');
                                    uploadButton.classList.remove('hidden');
                                }

                                const bioInput = document.getElementById('bio-input');
                                const bioCounter = document.getElementById('bio-counter');
                                const maxWords = 50;

                                bioInput.addEventListener('input', function () {
                                    const bioText = bioInput.value;

                                    // split into words
                                    const words = bioText.split(/\s+/);
                                    const wordCount = words.length;

                                    bioCounter.textContent = `Remaining words: ${maxWords - wordCount}`;

                                    if (wordCount > maxWords) {
                                        const trimmedText = words.slice(0, maxWords).join(' ');
                                        bioInput.value = trimmedText;
                                        bioCounter.textContent = 'Maximum word limit reached';
                                    }
                                });

                                function showStepOne() {
                                    const part1Id = document.getElementById('part-1');
                                    const part2Id = document.getElementById('part-2');
                                    const part3Id = document.getElementById('part-3');

                                    if (!part1Id.classList.contains('active'))
                                        part1Id.classList.add('active');

                                    if (part2Id.classList.contains('active'))
                                        part2Id.classList.remove('active');

                                    if (part3Id.classList.contains('active'))
                                        part3Id.classList.remove('active');
                                }

                                function showStepOne() {
                                    const part1Id = document.getElementById('part-1');
                                    const part2Id = document.getElementById('part-2');
                                    const part3Id = document.getElementById('part-3');

                                    part1Id.classList.add('active');

                                    if (part2Id.classList.contains('active')) {
                                        part2Id.classList.remove('active');
                                    }

                                    if (part3Id.classList.contains('active')) {
                                        part3Id.classList.remove('active');
                                    }
                                }

                                function showStepTwo() {
                                    const part1Id = document.getElementById('part-1');
                                    const part2Id = document.getElementById('part-2');
                                    const part3Id = document.getElementById('part-3');

                                    part2Id.classList.add('active');

                                    if (part1Id.classList.contains('active')) {
                                        part1Id.classList.remove('active');
                                    }

                                    if (part3Id.classList.contains('active')) {
                                        part3Id.classList.remove('active');
                                    }
                                }

                                function showStepThree() {
                                    const part1Id = document.getElementById('part-1');
                                    const part2Id = document.getElementById('part-2');
                                    const part3Id = document.getElementById('part-3');

                                    part3Id.classList.add('active');

                                    if (part1Id.classList.contains('active')) {
                                        part1Id.classList.remove('active');
                                    }

                                    if (part2Id.classList.contains('active')) {
                                        part2Id.classList.remove('active');
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
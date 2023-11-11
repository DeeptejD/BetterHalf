<?php
if (isset($_POST['logout']))

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Inter", sans-serif;
        }

        .font-sans {
            font-family: "Inter", sans-serif;
        }

        .font-semibold {
            font-weight: 600;
            /* Adjust the weight as needed */
        }
    </style>

</head>


<body>

    <div class="mx-0 pr-4 h-full w-1/4">
        <div class=" shadow-2xl rounded-r-xl h-full">
            <div class="flex flex-row col-span-2 h-full bg-gray-950 rounded-r-xl shadow-2xl bg-opacity-20 backdrop-blur-xl p-4">
                <nav class=" flex flex-col justify-between h-full w-full rounded-xl p-4">
                    <div class="h-4/5 space-y-4">
                        <div class="flex flex-row items-center justify-center mb-11">
                            <a href="../dashboard/dash.php">
                                <img src="../../images/OG-images/horizontalnoBG.png" class="w-48">
                            </a>

                        </div>
                        <div class="h-1/2 w-full rounded-xl space-y-4">
                            <div> <a href="../dashboard/dash.php">
                                    <button class="text-white md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-2xl text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                        Home
                                    </button>
                                </a></div>
                            <div> <a href="../chat/users.php">
                                    <button class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                        Chat
                                    </button>
                                </a></div>
                            <div> <a href="../calendar/calendar.php">
                                    <button class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                        Calendar
                                    </button>
                                </a></div>
                            <div> <a href="../discover/feed.php">
                                    <button class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                        Discover
                                    </button>
                                </a></div>
                            <!-- <button class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                    Kundali
                                </button> -->
                            <div> <a href="../map/map.php">
                                    <button class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl mb-14 bg-opacity-50 transform duration-100 hover:scale-105">
                                        Map
                                    </button>
                                </a></div>
                        </div>
                    </div>
                    <div class="h-1/5">
                        <div class="rounded-xl w-full h-full pt-10">
                            <!-- <a href="nav.php">
                                <button
                                    class=" ">
                                    Log-Out
                                </button>
                            </a> -->
                            <form action="../authentication/logout.php">
                                <input type="submit" name="logout" value="Logout" class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl hover:bg-red-700 hover:text-white hover:opacity-100 transition ease-in-out hover:shadow-2xl space-y-12 bg-opacity-30 transform duration-100 hover:scale-105 w-full">
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</body>

</html>
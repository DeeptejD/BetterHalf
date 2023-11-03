<?php
if (isset($_POST['logout']))

?>


<div class="mx-0 pr-4 h-full w-1/4">
    <div class=" shadow-2xl rounded-r-xl h-full">
        <div class="flex flex-row col-span-2 h-full bg-gray-950 rounded-r-xl shadow-2xl bg-opacity-20 backdrop-blur-xl p-4">
            <nav class=" flex flex-col justify-between h-full w-full rounded-xl p-4">
                <div class="h-4/5 space-y-4">
                    <div class="flex flex-row items-center justify-center">
                        <a href="../dashboard/dash.php">
                            <img src="../../images/OG-images/logo.png" class="h-28 w-28">
                        </a>

                    </div>
                    <div class="h-1/2 w-full rounded-xl space-y-4">
                        <a href="../dashboard/dash.php">
                            <button
                                class="text-white md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-2xl text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                Home
                            </button>
                            <a href="../chat/users.php">
                                <button
                                class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                Chat
                            </button>
                            </a>
                            <a href="../calendar/calendar.php">
                                <button
                                    class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                    Calendar
                                </button>
                            </a>
                            <button
                                class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                Kundali
                            </button>
                            <button
                                class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-medium font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl mb-14 bg-opacity-50 transform duration-100 hover:scale-105">
                                Map
                            </button>
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
                            <input type="submit" name="logout" value="Logout"
                                class="text-white text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl hover:bg-red-700 hover:text-white hover:opacity-100 transition ease-in-out hover:shadow-2xl space-y-12 bg-opacity-30 transform duration-100 hover:scale-105 w-full">
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
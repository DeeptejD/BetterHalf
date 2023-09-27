<?php
session_start();

// Check if the user is logged in (adjust this according to your authentication mechanism)
if (!isset($_SESSION['user_email'])) {
    header("location: ../not_logged_in.html");
}

// echo $_SESSION['user_email'];

$servername = "localhost";
$username = "root";
$password = "";
$database = "loginpage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch events for the logged-in user
    $user_email = $_SESSION['user_email'];
    $stmt = $conn->prepare("SELECT id, event_title, start_date, end_date FROM calendar WHERE user_email = :user_email");
    $stmt->bindParam(':user_email', $user_email);
    $stmt->execute();

    $events = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $startDateTime = new DateTime($row['start_date']);
        $endDateTime = new DateTime($row['end_date']);

        $formattedStart = $startDateTime->format('Y-m-d\TH:i:s');
        $formattedEnd = $endDateTime->format('Y-m-d\TH:i:s');

        $event = new stdClass();
        // $event->id = $row['id'];
        $event->title = $row['event_title'];
        $event->start = $formattedStart;
        $event->end = $formattedEnd;

        $events[] = $event;
    }

    // echo json_encode($events);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />
    <meta name="description" content="Schedule Events using the integrated Calendar">
    <meta property="og:image" content="../../images/OG-images/calendar-meta.png">

    <title>Calendar</title>

    <!-- scripts necessary to run fullcalendar -->
    <script src="
https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js
"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.9/index.global.min.js"></script>
    <script src='fullcalendar/dist/index.global.js'></script>

    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- icons by font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.9/css/all.min.css">

    <!-- flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

    <!-- datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>

    <style>
        /* fullcalendar styles */
        :root {
            --fc-small-font-size: .85em;
            --fc-page-bg-color: #fff;
            --fc-neutral-bg-color: rgba(208, 208, 208, 0.3);
            --fc-neutral-text-color: #808080;
            --fc-border-color: black;

            --fc-button-text-color: #fff;
            --fc-button-bg-color: #001e3d;
            /* This is for the header button colors */
            --fc-button-border-color: #2C3E50;
            --fc-button-hover-bg-color: #1e2b37;
            --fc-button-hover-border-color: #1a252f;
            --fc-button-active-bg-color: #1a252f;
            --fc-button-active-border-color: #151e27;

            --fc-event-bg-color: #3788d8;
            --fc-event-border-color: #3788d8;
            --fc-event-text-color: #fff;
            --fc-event-selected-overlay-color: rgba(0, 0, 0, 0.25);

            --fc-more-link-bg-color: #d0d0d0;
            --fc-more-link-text-color: inherit;

            --fc-event-resizer-thickness: 8px;
            --fc-event-resizer-dot-total-width: 8px;
            --fc-event-resizer-dot-border-width: 1px;

            --fc-non-business-color: rgba(215, 215, 215, 0.3);
            --fc-bg-event-color: rgb(143, 223, 130);
            --fc-bg-event-opacity: 0.3;
            --fc-highlight-color: rgba(188, 232, 241, 0.3);
            --fc-today-bg-color: rgba(255, 220, 40, 0.15);
            --fc-now-indicator-color: red;
        }

        /* Custom CSS for colored chips in the dropdown */
        select[name="event_color"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-left: 30px;
            /* Adjust as needed */
            background-position: left center;
            background-repeat: no-repeat;
        }

        select[name="event_color"] option {
            padding-left: 25px;
            /* Adjust as needed */
            background-repeat: no-repeat;
            background-size: 20px;
            /* Adjust as needed */
            padding: 5px 0;
            /* Adjust as needed */
        }

        /* Define the chip color based on data-color attribute */
        select[name="event_color"] option[data-color="red"] {
            background-image: url('red-chip.png');
            /* Replace with your chip image or use a background-color */
            color: white;
        }

        select[name="event_color"] option[data-color="blue"] {
            background-image: url('blue-chip.png');
            /* Replace with your chip image or use a background-color */
            color: white;
        }

        select[name="event_color"] option[data-color="green"] {
            background-image: url('green-chip.png');
            /* Replace with your chip image or use a background-color */
            color: white;
        }
    </style>
</head>

<body>
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen"
        style="background-image: url('../../images/dashboard/background-4.jpg');">
        <div class="flex justify-between h-full py-3">
            <!-- this is the side nav, do not touch -->
            <div class="mx-0 pr-4 h-full w-1/4">
                <div class=" shadow-2xl rounded-r-xl h-full">
                    <div class="flex flex-row col-span-2 h-full bg-gray-700 rounded-r-xl shadow-2xl bg-opacity-50 p-4"
                        style="backdrop-filter: blur(8px);"">
                  <nav class=" flex flex-col justify-between h-full w-full rounded-xl p-4">
                        <div class="h-4/5 space-y-4">
                            <div class="flex flex-row items-center justify-center">
                                <a href="../dashboard/dash.html">
                                    <div class="bg-gray-900 rounded-full w-20 h-20"></div>
                                </a>

                            </div>
                            <div class="h-1/2 w-full rounded-xl space-y-4">
                                <button
                                    class="text-gray-900 md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-2xl text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                    Home
                                </button>
                                <button
                                    class="text-gray-900 text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                    Chat
                                </button>
                                <a href="../calendar/calendar.html">
                                    <button
                                        class="text-gray-900 text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                        Calendar
                                    </button>
                                </a>
                                <button
                                    class="text-gray-900 text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition ease-in-out hover:shadow-2xl bg-opacity-50 transform duration-100 hover:scale-105">
                                    Kundali
                                </button>
                                <button
                                    class="text-gray-900 text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl w-full hover:bg-black  hover:text-gray-100 transition  ease-in-out hover:shadow-2xl mb-14 bg-opacity-50 transform duration-100 hover:scale-105">
                                    Map
                                </button>
                            </div>
                        </div>
                        <div class="h-1/5">
                            <div class="rounded-xl w-full h-full pt-10">
                                <a href="../authentication/login.php">
                                    <button
                                        class="text-gray-900 text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl h-16 text-center font-light font-sans p-8 pt-4 pb-4 rounded-xl hover:bg-red-700 hover:text-white hover:opacity-100 transition ease-in-out hover:shadow-2xl space-y-12 bg-opacity-30 transform duration-100 hover:scale-105 w-full ">
                                        Log-Out
                                    </button>
                                </a>
                            </div>
                        </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
                <div class="col-span-2 row-span-5 w-full h-full rounded-xl pr-4 bg-gray-700 bg-opacity-50 p-4 flex flex-col space-y-2"
                    style="backdrop-filter: blur(8px);">
                    <div class="bg-gray-700 shadow-xl bg-opacity-50 h-3/6 rounded-t-2xl flex flex-col">
                        <div class="h-1/6 w-full flex flex-col items-center justify-center bg-white rounded-t-xl">
                            <h1 class="text-center text-gray-900 text-xl font-sans">Upcoming Events</h1>
                        </div>
                        <div id="daycalendar"
                            class="w-full font-sans font-light h-full bg-gray-700 text-white text-shadow-2xl  bg-opacity-50 text-xl font-bold text-gray-950 shadow-2xl"
                            style="backdrop-filter: blur(8px);"></div>
                    </div>

                    <!-- this is supposed to show the single date or something -->
                    <div class="w-full h-2/6 bg-gray-700 shadow-xl bg-opacity-50 rounded-2xl">
                    </div>

                    <!-- Modal toggle -->
                    <div class="h-1/6 rounded-2xl">
                        <button data-modal-target="new-event-modal" data-modal-toggle="new-event-modal"
                            class="block text-gray-900 text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl text-center  font-sans p-8 pt-4 pb-4 rounded-xl  hover:opacity-100 transition ease-in-out hover:shadow-2xl space-y-12 bg-gray-700 shadow-lg hover:shadow-indigo-500/100 hover:text-indigo-950 hover:bg-indigo-300 bg-opacity-30 transform duration-100 hover:scale-90 w-full text-center h-full hover:shadow-2xl font-semibold"
                            type="button">
                            Create
                        </button>
                    </div>
                </div>

                <!-- Main modal -->
                <div id="new-event-modal"
                    class="fixed top-0 left-0 right-0 z-50 hidden h-full w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
                    style="backdrop-filter: blur(8px);">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow bg-white dark:bg-opacity-10 bg-opaicyt-60"
                            style="backdrop-filter: blur(8px);">
                            <button type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="new-event-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="px-6 py-6 lg:px-8">
                                <h3 class="mb-8 text-4xl font-medium text-gray-900 dark:text-white">Add
                                    event details
                                </h3>
                                <hr class="my-4 border-gray-600">
                                <form class="space-y-6" action="insert_event.php" method="POST">
                                    <!-- title -->
                                    <div>
                                        <label for="event_title"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                        <input type="text" name="event_title" id="event_title"
                                            class="shadow-indigo-500/100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-300 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Enter your event title here" required>
                                    </div>

                                    <!-- <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="shadow-indigo-500/100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-300 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="johndoe@example.com" required>
                                    </div> -->

                                    <hr class="my-4 border-gray-600">

                                    <!-- date time select -->
                                    <div class="flex flex-col w-full space-y-3">
                                        <!-- start -->
                                        <label for="startDate"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start</label>
                                        <div class="flex flex-row space-x-3 w-full h-full">
                                            <input type="date" name="startDate" id="startDate"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-300 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                required>
                                            <input type="time" name="startTime" id="startTime"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-300 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                required>
                                        </div>
                                        <!-- end -->
                                        <label for="endDate"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End</label>
                                        <div class="flex flex-row space-x-3 w-full h-full">
                                            <input type="date" name="endDate" id="endDate"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-300 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                required>
                                            <input type="time" name="endTime" id="endTime"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-300 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                required>
                                        </div>
                                    </div>

                                    <!-- <div date-rangepicker class="flex items-center w-full">
                                        <div class="relative w-1/2">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input name="start" type="text"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 border border-gray-300"
                                                placeholder="Select date start">
                                        </div>
                                        <span class="mx-4 text-gray-500">to</span>
                                        <div class="relative w-1/2">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input name="end" type="text"
                                                class=" border border-gray-300 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Select date end">
                                        </div>
                                    </div> -->


                                    <div class="flex flex-row">
                                        <!-- allday -->
                                        <div class="flex items-center w-1/2">
                                            <div class="flex items-center h-5">
                                                <input id="allDay" type="checkbox" value="" name="allDay"
                                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                                    required>
                                            </div>
                                            <label for="allDay"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">All
                                                Day</label>
                                        </div>
                                    </div>

                                    <hr class="my-4 border-gray-600">

                                    <!-- desc -->
                                    <label for="eventDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                        Description</label>
                                    <textarea id="eventDescription" rows="4" name="eventDescription"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-300 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Enter Event Description here ..."></textarea>

                                    <div>
                                        <label for="eventLink"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                            URL</label>
                                        <input type="url" name="eventLink" id="eventLink"
                                            placeholder="https://example.com"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-300 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    </div>

                                    <input type="submit" name="submit" id="submit"
                                        class="block text-gray-900 text-sm md:text-base lg:text-lg xl:text-xl 2xl:text-2xl 3xl:text-3xl 4xl:text-4xl 5xl:text-5xl 6xl:text-6xl text-center  font-sans p-8 pt-4 pb-4 rounded-xl  hover:opacity-100 transition ease-in-out hover:shadow-2xl space-y-12 bg-indigo-500 shadow-lg hover:shadow-indigo-500/100 hover:text-indigo-950 hover:bg-indigo-300 transform duration-100 hover:scale-105 w-full text-center h-full hover:shadow-2xl font-semibold" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-span-7 col-start-3 row-span-5 mr-4 rounded-2xl shadow-2xl bg-cover bg-center"
                    style="background-image: url('../../images/dashboard/background-2.jpg');">
                    <div id='calendar'
                        class=" w-full font-sans font-light h-full bg-gray-700 text-white text-shadow-2xl p-4 rounded-2xl bg-opacity-50 text-xl font-bold text-gray-950 shadow-2xl"
                        style="backdrop-filter: blur(8px);"></div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // retrieve events from database
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var user_email = "deeptejdhauskar2003@gmail.com";
            console.log(user_email);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                navLinks: true,
                timeZone: 'local',
                events: <?php echo json_encode($events); ?>,
                eventClick: function (info) {
                    alert('Event: ' + info.event.title + '\n\n'
                        + 'Starts:' + info.event.start + '\n\n' + 'Ends:' + info.event.end
                    );
                    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    // alert('View: ' + info.view.type);
                }
            });

            calendar.render();
        });


        var daycalendarEl = document.getElementById('daycalendar');
        var daycalendar = new FullCalendar.Calendar(daycalendarEl, {
            initialView: 'listDay',
            headerToolbar: {
                start: '',
                center: '',
                end: '',
            },
            selectable: true,
            events: <?php echo json_encode($events); ?>
        });

        daycalendar.render();

    </script>
</body>

</html>
<?php

session_start();
include_once "../config.php";
if (!isset($_SESSION['user_email'])) {
    header("location: ../authentication/login.php");
}

// FETCHING USERS WITH THEIR IMAGES
// Modify the SQL query to join the tables and fetch user data along with user names and image URLs

// $sql = "SELECT GIS.user_email, GIS.latitude, GIS.longitude, register.user_name, details.imgurl
//         FROM GIS
//         JOIN register ON GIS.user_email = register.user_email
//         JOIN details ON GIS.user_email = details.user_email";
// $result = $conn->query($sql);

// // Fetch user data as an associative array
// $user_data = array();
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $user_data[] = $row;
//     }
// }

// FETCHING USERS WITHOUT THEIR IMAGES
$sql = "SELECT gis.user_email, gis.latitude, gis.longitude, register.user_name FROM gis JOIN register ON gis.user_email = register.user_email";
$result = $conn->query($sql);

// Fetch user data as an associative array
$user_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_data[] = $row;
    }
}

?>

<!-- PHP ends here -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <!-- swal themes -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


    <title>Map</title>
    <link rel="icon" type="image/x-icon" href="../../images/map/favicon.ico">


    <!-- styles to remove scrollbar -->
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
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen bg-blur-2xl"
        style="background-image: url('../../images/map/map-bg.png'); backdrop-filter: blur(8px);">
        <div class="flex justify-between h-full py-3">

            <!-- nav -->
            <?php include '../../modules/partials/nav.php' ?>

            <div class="ml-0 container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
                <div class="col-span-9 row-span-5 pr-4 rounded-xl">
                    <div id="map" class="col-span-9 row-span-5 h-full rounded-2xl shadow-2xl"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Leaflet JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // initalize leaflet map
            var map = L.map('map').setView([40.793619065120986, -73.9516078574651], 18);
            var userMarker;

            // open strt map tile later
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // plot users on the map
            <?php
            foreach ($user_data as $user) {
                $name = $user['user_name'];
                echo "L.marker([" . $user['latitude'] . ", " . $user['longitude'] . "]).addTo(map).bindPopup('$name');";
            }
            ?>
            // when user location is found
            function onLocationFound(e) {

                // initialize variables
                var latitude = e.latlng.lat;
                var longitude = e.latlng.lng;

                // Send location data to the server
                fetch('update-location.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ latitude, longitude }),
                })
                    .then(response => {
                        if (response.ok) {
                            console.log('Location data updated on the server.');
                        } else {
                            console.error('Failed to update location data on the server.');
                        }
                    })
                    .catch(error => {
                        console.error('Error sending location data:', error);
                    });

                // set user marker
                var radius = e.accuracy / 2;
                if (!userMarker) {
                    userMarker = L.marker(e.latlng).addTo(map);
                } else {
                    userMarker.setLatLng(e.latlng);
                }

                userMarker.bindPopup("You are here 👀").openPopup();

                if (!userMarker.circle) {
                    userMarker.circle = L.circle(e.latlng, radius).addTo(map);
                } else {
                    userMarker.circle.setLatLng(e.latlng).setRadius(radius);
                }

                map.setView(e.latlng, 17);
            }

            // Perimission denied
            function onLocationError(e) {
                if (!(e.code === e.PERMISSION_DENIED)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Aww snap 🗺️',
                        text: 'You need to enable location permissions to use maps',
                    })
                }
            }

            map.on('locationfound', onLocationFound);
            map.on('locationerror', onLocationError);

            // continuously tracks user location
            map.locate({ setView: true, watch: true, maxZoom: 17 });
        });
    </script>
</body>

</html>
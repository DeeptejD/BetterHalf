<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kundali Score Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
</head>

<body>
    <div class="bg-cover bg-center md:overflow-hidden h-full md:h-screen w-screen flex flex-col md:px-5"
    style="background-image: url('../../images/dashboard/background.jpg');">
    <div class="flex  h-full py-3">
    <?php include '../../modules/partials/nav.php' ?>
    <div class="h-screen flex items-center justify-center">
        <div class="bg-white bg-opacity-20 p-8 rounded shadow-md max-w-md w-full">
            <h1 class="text-2xl text-white mb-4 text-center">Kundali Score Calculator</h1>
            <form action="" method="post" class="space-y-4">
                <div>
                    <label for="name" class="block text-white">Name:</label>
                    <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="dob" class="block text-white">Date of Birth:</label>
                    <input type="date" name="dob" id="dob" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="time" class="block text-white">Time of Birth:</label>
                    <input type="time" name="time" id="time" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="place" class="block text-white">Place of Birth:</label>
                    <input type="text" name="place" id="place" class="w-full border rounded p-2" required>
                </div>
                <div class="flex justify-center">
                    <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Calculate Kundali Score</button>
                </div>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                // Perform Kundali score calculation here
                // Replace this with your own Kundali score calculation logic
                $kundaliScore = rand(50, 100);

                echo "<div class='mt-4 text-white text-center'><strong>Kundali Score:</strong> $kundaliScore</div>";
            }
            ?>
        </div>
    </div>
</body>
    </div>

</html>

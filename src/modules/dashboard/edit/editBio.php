<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Enter new Bio</title>
</head>

<body>
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen backdrop-blur-2xl "
        style="background-image: url('../../../images/dashboard/background-3.jpg');">
        <div class="flex justify-between h-full py-3">

            <?php include '../../partials/nav.php' ?>

            <div class="container grid grid-cols-9 grid-rows-5 gap-4 h-full w-screen mx-auto my-auto">
                <div
                    class="col-span-9 row-span-5 rounded-xl mx-3 my-0 bg-gray-950 bg-opacity-50 backdrop-blur-2xl shadow-2xl px-32 py-11 flex flex-col space-y-5">
                    <div
                        class="w-full h-1/4 rounded-2xl bg-gray-50 bg-opacity-30 backdrop-blur-2xl shadow-2xl text-4xl font bold text-gray-950 text center flex items-center font-bold justify-center">
                        <h1>Enter your new Bio</h1>
                    </div>
                    <form
                        class="bg-gray-50 rounded-2xl shadow-2xl w-full h-3/4 p-11 px-12 bg-opacity-30 backdrop-blur-2xl">
                        <textarea
                            class="w-full h-48 bg-gray-300 rounded-2xl p-6 h-full text-2xl text-gray-950 font-semibold bg-opacity-50 backdrop-blur-2xl"
                            placeholder="Enter new bio (Maximum 50 words)"></textarea>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <script>


    </script>

</body>

</html>
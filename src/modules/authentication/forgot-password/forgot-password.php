<?php include '../../config.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../../partials/head-content.php'; ?>
    <title>Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="../../../images/OG-images/favicon.ico">
    <!-- css to be added later -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- <h1>Forgot Password</h1>
    <form method="POST" action="send-reset-link.php">
        <label for="email">Enter your email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form> -->
    <div class="bg-cover bg-center md:overflow-hidden h-screen w-screen flex flex-col md:px-5" style="background-image: url('../../../images/dashboard/background.jpg');">
        <div class="m-4 mb-0">
            <nav class="w-full h-12 rounded-full md:p-2 bg-gray-100 flex flex-row justify-between items-center bg-opacity-25 shadow-2xl" style="backdrop-filter: blur(8px);">
                <a href="../../../../index.html" class="hidden md:block  text-semibold flex justify-center items-center font-semibold pl-6">
                        <img href="index.html"><img src="../../../images/OG-images/horizontalnoBG.png" alt="BetterHalf" class="w-36"></img>
                </a>
                <a href=" #" class=" md:hidden m-2 text-semibold flex justify-center items-center font-semibold pl-6">Logo</a>
                <div class="flex flex-row space-x-4">
                    <a href="../register.php" class=" m-2 text-semibold flex justify-center items-center font-semibold pr-6">Sign
                        Up</a>
                    <a href="../login.php" class=" m-2 text-semibold flex justify-center items-center font-semibold pr-6">Log in</a>
                </div>
            </nav>
        </div>
        <div class="h-2/3 md:flex-grow bg-white m-4 rounded-xl flex md:flex-row flex-col bg-opacity-25 shadow-2xl" style="backdrop-filter: blur(8px);">
            <div class="bg-gray-900 md:rounded-l-xl rounded-t-xl md:w-1/3 w-full md:h-full h-1/4 overflow-hidden">
                <img src="../../../images/forgot-password/forgot-side.gif" alt="" class="hidden md:block object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
                <img src="../../../images/forgot-password/small-screen.gif" alt="" class="md:hidden block object-cover rounded-t-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
            </div>
            <div class="flex-grow rounded-r-xl md:ml-5 p-5 flex flex-col justify-center items-center">
                <form action="send-reset-link.php" method="post" class="w-full md:py-6 px-2">
                    <h1 class="text-gray-100  text-2xl md:text-3xl font-bold md:pb-3 md:mb-6 pb-1 mb-2">
                        Enter your Email</h1>
                    <div class="pt-2">
                        <label for="email" class="text-white text-lg font-semibold shadow-2xl pl-2">Email</label>
                        <input type="email" name="email" id="email" class="w-full rounded-2xl shadow-2xl bg-gray-50 p-5  focus:outline-none">
                    </div>
                    <div class="flex flex-row justify-end pt-5 md:pt-11">
                        <input type="submit" name="submit" id="submit" class="md:w-1/5 w-full shadow-2xl text-center p-5 h-full rounded-xl bg-lime-100 hover:bg-lime-100 active:bg-lime-200  active:shadow-inner font-semibold transition transform duration-500 hover:scale-90 active:scale-80 focus:outline-none" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
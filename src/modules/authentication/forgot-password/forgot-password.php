<?php include '../../config.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../../partials/head-content.php'; ?>
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
    <div class="bg-cover bg-center overflow-hidden h-screen w-screen flex flex-col px-5"
        style="background-image: url('../../../images/dashboard/background-2.jpg');">
        <div class="m-4 mb-0">
            <nav class="w-full h-12 rounded-full p-2 bg-gray-100 flex flex-row justify-between bg-opacity-25 shadow-2xl"
                style="backdrop-filter: blur(8px);">
                <a href=" #" class=" m-2 text-semibold flex justify-center items-center font-semibold pl-6">Logo
                    goes here</a>
                <div class="flex flex-row space-x-4">
                    <a href="../register.php"
                        class=" m-2 text-semibold flex justify-center items-center font-semibold pr-6">Sign
                        Up</a>
                    <a href="../login.php"
                        class=" m-2 text-semibold flex justify-center items-center font-semibold pr-6">Log in</a>
                </div>
            </nav>
        </div>
        <div class="flex-grow bg-white m-4 rounded-xl flex flex-row bg-opacity-25 shadow-2xl"
            style="backdrop-filter: blur(8px);">
            <div class="bg-gray-900 rounded-l-xl w-1/3 h-full overflow-hidden">
                <img src="../../../images/forgot-password/forgot-side.gif" alt=""
                    class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
            </div>
            <div class="flex-grow rounded-r-xl ml-5 p-5 flex flex-col justify-center items-center">
                <form action="send-reset-link.php" method="post" class="w-full py-6 px-2">
                    <h1 class="text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold pb-3 mb-6">
                        Enter your Email</h1>
                    <div class="pt-2">
                        <label for="email" class="text-white text-lg font-semibold shadow-2xl pl-2">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full rounded-2xl shadow-2xl bg-white p-5  focus:outline-none">
                    </div>
                    <div class="flex flex-row justify-end pt-11">
                        <input type="submit" name="submit" id="submit"
                            class="w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-lime-100 active:bg-lime-200  active:shadow-inner font-semibold transition transform duration-500 hover:scale-110 focus:outline-none" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
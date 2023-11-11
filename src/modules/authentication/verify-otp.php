<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Verify OTP</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="../../images/OG-images/favicon.ico" type="image/x-icon">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- <div>
        <div class="form">
            <h1>Verify OTP</h1>
            <form action="verify-otp-process.php" method="POST">
                <div class="nameinput">
                        Enter the OTP sent to your email
                    <br>
                    <input type="text" id="otp" name="otp" required>
                </div>
                <button id="sbmitbtn" type="submit">Verify OTP</button>
            </form>
        </div>
    </div> -->

    <div class="bg-cover bg-center overflow-hidden h-screen w-screen " style="background-image: url('../../images/dashboard/background-2.jpg');">
        <div class="min-h-screen flex items-center justify-center shadow-2xl">
            <div class="h-screen w-screen py-11 px-52">
                <div class="bg-gray-200 bg-opacity-25 bg-blur rounded-xl flex flex-row h-full w-full " style="backdrop-filter: blur(8px);">
                    <div class="bg-gray-900 rounded-l-xl w-1/3 h-full overflow-hidden">
                        <img src="../../images/otp/otp.gif" alt="" class="object-cover rounded-l-xl shadow-xl h-full w-full object-center transition transform duration-500 hover:scale-110  ">
                    </div>
                    <div class="w-2/3 h-full p-4 rounded-r-xl">
                        <div class="space-y-1 p-5 flex flex-col justify-center items-center h-full">
                            <form action="verify-otp-process.php" method="POST" class="w-full py-6 px-2">
                                <h1 class="text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold pb-2 mb-2">
                                    Enter your OTP</h1>
                                <p class="text-gray-100 font-thin text-sm pb-3 mb-6">Check
                                    your Inbox. Dont forget to check your spam!</p>
                                <div class="flex space-x-4">
                                    <input type="text" name="digit1" class="w-20 h-16 focus:outline-none text-center border rounded-lg rounded-l-full otp-input" maxlength="1">
                                    <input type="text" name="digit2" class="w-20 h-16 focus:outline-none text-center border rounded-lg otp-input" maxlength="1">
                                    <input type="text" name="digit3" class="w-20 h-16 focus:outline-none text-center border rounded-lg otp-input" maxlength="1">
                                    <input type="text" name="digit4" class="w-20 h-16 focus:outline-none text-center border rounded-lg otp-input" maxlength="1">
                                    <input type="text" name="digit5" class="w-20 h-16 focus:outline-none text-center border rounded-lg otp-input" maxlength="1">
                                    <input type="text" name="digit6" class="w-20 h-16 focus:outline-none text-center border rounded-lg rounded-r-full otp-input" maxlength="1">
                                </div>

                                <div class="flex flex-row justify-end pt-8">
                                    <button id="sbmitbtn" type="submit" class=" p-5 rounded-xl font-semibold transition transform duration-500 hover:scale-110  bg-slate-200 hover:bg-lime-100 active:bg-lime-200">Verify
                                        OTP</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const otpInputs = document.querySelectorAll('.otp-input');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1) {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }

                }
            });

            // Handle backspace to move focus to the previous input
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && e.target.value.length === 0) {
                    if (index > 0) {
                        otpInputs[index - 1].focus();
                    }
                }
            });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>BetterHalf - Find your partner</title>

    <!-- SmoothScroll Polyfill -->
    <!-- <script src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script> -->

    <!-- Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Plus:ital,wght@0,700;1,400;1,700&family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Gentium Book Plus', serif;
        }

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

<body class="overflow-x-hidden scrollbar-hide w-screen min-h-screen">
    <div class="w-full h-full flex flex-col">


        <!-- hero -->
        <div class="w-full h-screen object-center bg-cover flex flex-col" style="background-image: url(./hero.jpg);">
            <!-- nav -->
            <div class="z-10 text-lg w-full fixed bg-opacity-50 backdrop-blur-2xl transition-all duration-300 h-20 rounded-b-xl border-2 border-t-0 border-gray-200  flex flex-row justify-between text-gray-950  items-center px-11">
                <!-- logo -->
                <div>
                    BetterHalf
                </div>
                <div class="flex flex-row space-x-4">
                    <div class="mr-11 hover:bg-yellow-950 hover:px-7 transition-all duration-500 p-3 rounded-md hover:text-white">About</div>
                    <div class="hover:bg-yellow-950 hover:px-7 transition-all duration-500 p-3 rounded-md hover:text-white">Register</div>
                    <div class="hover:bg-yellow-950 hover:px-7 transition-all duration-500 p-3 rounded-md hover:text-white">Login</div>
                </div>
            </div>
            <div class="p-7 px-36 w-full flex-grow mt-20">
                <div class="w-full rounded-2xl h-full border-2 border-gray-200 flex justify-center items-center bg-gray-950 bg-opacity-10 backdrop-blur-xl">
                    <div class="flex flex-col text-white">
                        <div class="text-8xl font-semibold text-center items-center justify-center" style="font-family: 'Playfair Display', serif;">
                            Make the first move
                        </div>
                        <div class="flex flex-row space-x-6 items-center justify-center mt-10">
                            <div class="bg-yellow-950 px-11 p-5 rounded-lg font-semibold text-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 hover:translate-x-1">Join</div>
                            <div class="border-2 border-white px-11 p-5 rounded-lg font-semibold text-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 hover:translate-x-1 backdrop-blur-2xl bg-gray-950 text-white bg-opacity-20">Sign in</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- testimonial -->
        <div class=" bg-opacity-50 text-center text-6xl font-semibold w-full italic h-32 flex items-center justify-center">
            Testimonials
        </div>
        <div class="w-full min-h-screen items-center justify-center px-32">
            <div class="flex flex-row w-full h-full space-x-2">
                <div class="w-1/2 h-full flex flex-col  space-y-4 p-20 px-20 pr-10 items-center justify-center">
                    <div class="w-full h-full hover:backdrop-blur-2xl rounded-2xl "><div></div></div>
                    <div class=" w-full rounded-2xl bg-cover bg-center mb-11" style="height: 400px; background-image: url(./c1.jpg);"><div class="w-full h-full rounded-2xl transition-all duration-500 hover:backdrop-blur-2xl"></div></div>
                    <div class=" w-full rounded-2xl bg-cover bg-center" style="height: 400px; background-image: url(./c2.jpg);"><div class="w-full h-full rounded-2xl transition-all duration-500 hover:backdrop-blur-2xl"></div></div>
                </div>
                <div class="w-1/2 min-h-screen flex flex-col  space-y-4 p-6 items-center justify-center px-20 pl-10">
                    <div class=" w-full rounded-2xl bg-cover bg-center" style="height: 400px; background-image: url(./c3.jpg);"><div class="w-full h-full rounded-2xl transition-all duration-500 hover:backdrop-blur-2xl"></div></div>
                </div>
            </div>
        </div>



        <!-- Features -->
        <div class="bg-opacity-50 text-center text-6xl font-semibold w-full italic h-32 flex items-center justify-center">
            Features
        </div>
        <div class="w-full h-screen items-center justify-center py-32 px-16">
            <div class="flex flex-row space-x-11 w-full h-full">
                <div class="w-1/3 h-full hover:w-5/6 transition-all duration-300 flex-flex-col shadow-2xl rounded-2xl">
                    <div class="w-full hover:w-full h-full rounded-2xl border-1 border-gray-600 flex flex-col group transition-all duration-300 bg-cover bg-center" style="background-image: url('cal.png');">
                        <div class="h-1/2 group-hover:h-full bg-cover bg-center rounded-t-2xl transition-all duration-300"></div>
                        <!-- <div class="flex grow bg-cover bg-center rounded-b-2xl bg-opacity-20 backdrop-blur-2xl group-hover:w-0 transition-all duration-300"></div> -->
                    </div>
                    <div class="text-center text-xl">
                        <div class="text-2xl font-semibold text-center mt-5">Plan out events!</div>
                        <p>Intuitive and beautiful calendar to plan out your next date</p>
                    </div>
                </div>
                <div class="w-1/3 h-full hover:w-5/6 transition-all duration-300 flex-flex-col shadow-2xl rounded-2xl">
                    <div class="w-full hover:w-full h-full rounded-2xl border-1 border-gray-600 flex flex-col group transition-all duration-300 bg-cover bg-center" style="background-image: url('chat.png');">
                        <div class="h-1/2 group-hover:h-full bg-cover bg-center rounded-t-2xl transition-all duration-300"></div>
                        <!-- <div class="flex grow bg-cover bg-center rounded-b-2xl bg-opacity-20 backdrop-blur-2xl group-hover:w-0 transition-all duration-300"></div> -->
                    </div>
                    <div class="text-center text-xl">
                        <div class="text-2xl font-semibold text-center mt-5">Keep in touch</div>
                        <p>Chat with your friends and connections</p>
                    </div>
                </div>
                <div class="w-1/3 h-full hover:w-5/6 transition-all duration-300 flex-flex-col shadow-2xl rounded-2xl">
                    <div class="w-full hover:w-full h-full rounded-2xl border-1 border-gray-600 flex flex-col group transition-all duration-300 bg-cover bg-center" style="background-image: url('map.png');">
                        <div class="h-1/2 group-hover:h-full bg-cover bg-center rounded-t-2xl transition-all duration-300"></div>
                        <!-- <div class="flex grow bg-cover bg-center rounded-b-2xl bg-opacity-20 backdrop-blur-2xl group-hover:w-0 transition-all duration-300"></div> -->
                    </div>
                    <div class="text-center text-xl">
                        <div class="text-2xl font-semibold text-center mt-5">Interactive Map</div>
                        <p>
                            Find out connections near you in an interactive map!
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <script>
            // if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            //     document.documentElement.classList.add('dark')
            // } else {
            //     document.documentElement.classList.remove('dark')
            // }

            // localStorage.theme = 'light'
            // localStorage.theme = 'dark'
            // localStorage.removeItem('theme')
        </script>
</body>

</html>
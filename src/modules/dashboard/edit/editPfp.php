<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="bg-cover bg-center md:overflow-hidden h-full md:h-screen w-screen flex flex-col md:px-5" style="background-image: url('../../../images/dashboard/background.jpg');">
<div class="part part-2" id="part-2">
                                    <h1 class="text-gray-200 xl:text-4xl lg:text-3xl sm:text-lg font-bold mb-6">
                                        Upload your Profile Picture</h1>
                                    <p class="text-gray-200 font-bold mb-6  pb-3">
                                        This is how people will identify you!</p>
                                    <div class="flex items-center justify-center w-full" id="input-field">
                                        <label for="dropzone-file" class="flex flex-col items-center transition-all duration-500 justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-300 border-gray-600">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <div class=" hover:text-gray-50">
                                                    <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Click to upload</span>
                                                        or drag and drop</p>
                                                    <p class="text-xs text-gray-500">PNG, JPG or JPEG
                                                        (MAX. 800x400px)</p>
                                                </div>
                                            </div>
                                            <input type="file" id="dropzone-file" name="image" class="hidden" onchange="previewImage(this)" accept="image/*" />
                                        </label>
                                    </div>
                                    <!-- Displaying the uploaded profile picture -->
                                    <div class="flex justify-center items-center border-gray-700 ">
                                        <img id="profile-picture" name="image" class="rounded-full h-32 w-32 object-cover hidden" src="" alt="Profile Picture" />
                                    </div>
                                    <div class="flex flex-row justify-between pt-7">
                                        <a href="#" class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110" onclick="showStepOne()">Previous</a>

                                        <a href="#" id="upload-another" class="focus:outline-none hidden w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110" onclick="showFileInput()">Change</a>

                                        <a href=" #" class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110" onclick="showStepThree()">Next</a>
                                    </div>
                                </div>
</body>
</html>
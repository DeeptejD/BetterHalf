                                <div class="part part-1 active" id="part-1">
                                    <h1 class="text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold pb-3 mb-6">
                                        Personal
                                        Information</h1>

                                    <div class="flex flex-row space-x-3">
                                        <!-- DOB -->
                                        <div class="pt-2">
                                            <label for="dob" class="text-gray-950 text-lg font-semibold shadow-2xl pl-2">Date of
                                                birth</label>
                                            <input type="date" name="dob" id="dob" class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 uppercase p-5 focus:outline-none">
                                        </div>

                                        <!-- Marital -->
                                        <div class="pt-2 ">
                                            <label for="marital" class="text-gray-950  text-lg font-semibold shadow-2xl pl-2">Marital
                                                Status</label>
                                            <select name="marital" id="marital" class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 p-5 appearance-none focus:outline-none">
                                                <option value="Single">Single</option>
                                                <option value="Seperated">Seperated</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>

                                            </select>
                                        </div>
                                        <!-- Gender -->
                                        <div class="pt-2">
                                            <label for="gender" class="text-gray-950  text-lg font-semibold shadow-2xl  pl-2">Select
                                                Gender</label>
                                            <select name="gender" id="gender" class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 p-5 appearance-none focus:outline-none">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <!-- <option value="nonBinary">Non Binary</option> -->
                                            </select>
                                        </div>
                                    </div>


                                    <div class="flex flex-row space-x-3">
                                        <!-- Religion -->
                                        <div class="pt-2">
                                            <label for="religion" class="text-gray-950  text-lg font-semibold shadow-2xl pl-2">Religion</label>
                                            <select name="religion" id="religion" class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 p-5 appearance-none focus:outline-none" onchange="updateCasteOptions()">
                                                <option value="Hindu">Hindu</option>
                                                <option value="Muslim">Muslim</option>
                                                <option value="Christian">Christian</option>
                                                <option value="Buddhism">Buddhism</option>
                                                <option value="Sikhism">Sikhism</option>
                                                <option value="Judaism">Judaism</option>
                                                <option value="Jainism">Jainism</option>
                                                <option value="Zoroastrianism">Zoroastrianism</option>
                                                <option value="Atheist">Non-religious/Atheist</option>
                                                <option value="Agnostic">Agnostic</option>
                                                <option value="Bahai">Baháí Faith</option>
                                                <option value="Spiritual">Spiritual but not Religious</option>
                                            </select>
                                        </div>

                                        <!-- Caste -->
                                        <!-- <div class="pt-2">
                                            <label for="caste" class="text-gray-950  text-lg font-semibold shadow-2xl pl-2">Caste</label>
                                            <select name="caste" id="caste" class="w-full rounded-2xl appearance-none shadow-2xl bg-gray-200 active:bg-gray-300 p-5 focus:outline-none">
                                                <option value="None">None</option>
                                                <option value="brahmin">Brahmin</option>
                                                <option value="kshatriya">Kshatriya</option>
                                                <option value="vaishya">Vaishya</option>
                                                <option value="shudra">Shudra</option>
                                            </select>
                                        </div> -->

                                    </div>
                                    <div class="flex flex-row justify-end pt-7">
                                        <a href="#" class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110" onclick="showStepTwo()">Next</a>
                                    </div>
                                </div>
<div class="part part-4" id="part-4">
    <h1 class="text-gray-100  xl:text-4xl lg:text-3xl sm:text-lg font-bold mb-6">
        When planning a date, do you prefer a lively social event, such as a party or concert, or a quieter, intimate setting like a cozy dinner for two?
    </h1>
    <div class="flex flex-row space-x-3">
        <div class="pt-2">
            <label for="EI" class="text-gray-950  text-lg font-semibold shadow-2xl pl-2">Select</label>
            <select name="EI" id="religion" class="w-full rounded-2xl shadow-2xl bg-gray-200 active:bg-gray-300 p-5 appearance-none focus:outline-none" onchange="updateCasteOptions()">
                <option value="E">Large social event like a party or concert</option>
                <option value="I">Intimate setting like a cozy dinner for two</option>
            </select>
        </div>

    </div>
    <div class="flex flex-row justify-between pt-7 mt-5">
        <a href="#" class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110" onclick="showStepThree()">Previous</a>

        <a href="#" class="focus:outline-none w-1/5 text-center p-5 h-full rounded-xl bg-slate-200 hover:bg-slate-400 active:bg-slate-500 active:text-gray-50 active:shadow-inner font-semibold transition transform duration-500 hover:scale-110" onclick="showStepFive()">Next</a>
    </div>
</div>
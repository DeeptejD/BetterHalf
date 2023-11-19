function updateCasteOptions() {
    const religionSelect = document.getElementById("religion");
    const casteSelect = document.getElementById("caste");

    const selectedReligion = religionSelect.value;

    while (casteSelect.options.length > 0) {
        casteSelect.remove(0);
    }

    switch (selectedReligion) {
        case "hindu":
            casteSelect.add(new Option("Hindu", "Hindu"));
            casteSelect.add(new Option("Brahmin", "brahmin"));
            casteSelect.add(new Option("Kshatriya", "kshatriya"));
            casteSelect.add(new Option("Vaishya", "vaishya"));
            casteSelect.add(new Option("Shudra", "shudra"));
            casteSelect.add(new Option("Others", "hindu-others"));
            break;
        case "muslim":
            casteSelect.add(new Option("Muslim", "Muslim"));
            casteSelect.add(new Option("Sunni", "sunni"));
            casteSelect.add(new Option("Shia", "shia"));
            casteSelect.add(new Option("Others", "muslim-others"));
            break;
        case "christian":
            casteSelect.add(new Option("Catholic", "catholic"));
            casteSelect.add(new Option("Protestant", "protestant"));
            casteSelect.add(new Option("Orthodox", "orthodox"));
            casteSelect.add(new Option("Others", "christian-others"));
            break;
        default:
            casteSelect.add(new Option("None", "none"));

            break;
    }
}

// script to change the profile picture
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const profilePicture = document.getElementById('profile-picture');
            profilePicture.src = e.target.result;
            profilePicture.classList.remove('hidden');

            const inputfield = document.getElementById('input-field');
            inputfield.classList.add('hidden')

            const uploadAnotherButton = document.getElementById('upload-another');
            uploadAnotherButton.classList.remove('hidden')
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function showFileInput() {
    // show the input field
    const inputfield = document.getElementById('input-field');
    inputfield.classList.remove('hidden');

    // hide profile pic and change button
    const profilePicture = document.getElementById('profile-picture');
    profilePicture.classList.add('hidden');

    const uploadButton = document.getElementById('upload-button');
    uploadButton.classList.add('hidden');
}

function hideFileInput() {
    // hide input field
    const inputfield = document.getElementById('input-field');
    inputfield.classList.add('hidden');

    // show profile picture and change button
    const profilePicture = document.getElementById('profile-picture');
    profilePicture.classList.remove('hidden');

    const uploadButton = document.getElementById('upload-button');
    uploadButton.classList.remove('hidden');
}

const bioInput = document.getElementById('bio-input');
const bioCounter = document.getElementById('bio-counter');
const maxWords = 50;

bioInput.addEventListener('input', function () {
    const bioText = bioInput.value;

    // split into words
    const words = bioText.split(/\s+/);
    const wordCount = words.length;

    bioCounter.textContent = `Remaining words: ${maxWords - wordCount}`;

    if (wordCount > maxWords) {
        const trimmedText = words.slice(0, maxWords).join(' ');
        bioInput.value = trimmedText;
        bioCounter.textContent = 'Maximum word limit reached';
    }
});

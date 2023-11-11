
function handleRequestAction(buttonElement, action) {
    const requestId = buttonElement.getAttribute('data-request-id');
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_request.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    const data = 'request_id=' + requestId + '&action=' + action;

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            location.reload();
        }
    };

    xhr.send(data);

}

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('accept-button')) {
        handleRequestAction(event.target, 'accept');
    } else if (event.target.classList.contains('reject-button')) {
        handleRequestAction(event.target, 'reject');
    }
});


// SCRIPT TO HANDLE BIO EDIT
function editBio() {
    document.getElementById("bioDisplay").style.display = "none";
    document.getElementById("bioEdit").style.display = "block";
    document.getElementById("editBioButton").style.display = "none";
    document.getElementById("saveBioButton").style.display = "block";
    document.getElementById("edit-bio-flex").style.display = "flex";
    document.getElementById("edit-bio-btn-div").style.display = "none";
    document.getElementById("edit-bio-btn-div2").style.display = "none";
}



function saveBio() {
    const newBio = document.getElementById("bioEdit").value;

    // Update the bio in the database
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'update_bio.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    const data = 'bio=' + encodeURIComponent(newBio);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // put swal fire here
                Swal.fire({
                    icon: "success",
                    title: "Your bio has been updated",
                    showConfirmButton: true,
                    time: 1500
                });

                setTimeout(function () {
                    location.reload();
                }, 1500);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Could not update your Bio",
                    text: "Try again later",
                });
            }
        }
    };

    // Send the data to the server
    xhr.send(data);

    document.getElementById("bioDisplay").textContent = newBio;

    // Hide the edit mode and show the display mode
    document.getElementById("bioDisplay").style.display = "block";
    document.getElementById("bioEdit").style.display = "none";
    document.getElementById("editBioButton").style.display = "block";
    document.getElementById("saveBioButton").style.display = "none";
    document.getElementById("edit-bio-flex").style.display = "none";
    document.getElementById("edit-bio-btn-div").style.display = "flex";
    document.getElementById("edit-bio-btn-div2").style.display = "flex";

    // reload
    // location.reload();

}
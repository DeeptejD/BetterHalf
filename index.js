$("#sbmitbtn").on("click",function(){
    // var deez = $("#pass").value;
    var deez = document.getElementById("pass").value;
    var cnfpswd = document.getElementById("cnfrm-pass").value;
    if (deez !== cnfpswd) {
        alert("The password and confirm password differ!");
        document.getElementById("pass").value = "";
        document.getElementById("cnfrm-pass").value = "";
    }
})
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// Hide messages initially
document.getElementById("message-password").style.display = "none";
document.getElementById("message-confirm").style.display = "none";

// When the user clicks on the password field, show the message box
myInput.onfocus = function () {
    document.getElementById("message-password").style.display = "block";
    verifyPassword();
}

// When the user starts to type something inside the password field
myInput.onkeyup = verifyPassword;
function verifyPassword() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("text-danger");
        letter.classList.add("text-success");
        letter.innerHTML = "<i class='bi bi-check-lg'></i> Must have a <b>lowercase</b> letter";
    } else {
        letter.classList.remove("text-success");
        letter.classList.add("text-danger");
        letter.innerHTML = "<i class='bi bi-check-lg'></i> Must have a <b>lowercase</b> letter";
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("text-danger");
        capital.classList.add("text-success");
        capital.innerHTML = "<i class='bi bi-check-lg'></i> Must have a <b>capital (uppercase)</b> letter";
    } else {
        capital.classList.remove("text-success");
        capital.classList.add("text-danger");
        capital.innerHTML = "<i class='bi bi-x-lg'></i> Must have a <b>capital (uppercase)</b> letter";
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        number.classList.remove("text-danger");
        number.classList.add("text-success");
        number.innerHTML = "<i class='bi bi-check-lg'></i> Must have a <b>number</b>";
    } else {
        number.classList.remove("text-success");
        number.classList.add("text-danger");
        number.innerHTML = "<i class='bi bi-x-lg'></i> Must have a <b>number</b>";
    }

    // Validate length
    if (myInput.value.length >= 6) {
        length.classList.remove("text-danger");
        length.classList.add("text-success");
        length.innerHTML = "<i class='bi bi-check-lg'></i> Minimum <b>6 characters</b>";
    } else {
        length.classList.remove("text-success");
        length.classList.add("text-danger");
        length.innerHTML = "<i class='bi bi-x-lg'></i> Minimum <b>6 characters</b>";
    }
}

// Repeated
// When the user clicks on the password field, show the message box (repeat)
var myInputRep = document.getElementById("repeated_password");
var repeat = document.getElementById("repeat");
myInputRep.onfocus = function () {
    document.getElementById("message-confirm").style.display = "block";
    verifyConfirm();
}
// When the user starts to type something inside the password field (repeated)
myInputRep.onkeyup = verifyConfirm;
function verifyConfirm() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInputRep.value == myInput.value) {
        repeat.classList.remove("text-danger");
        repeat.classList.add("text-success");
        repeat.innerHTML = "<i class='bi bi-check-lg'></i> Password must <b>match</b>";
    } else {
        repeat.classList.remove("text-success");
        repeat.classList.add("text-danger");
        repeat.innerHTML = "<i class='bi bi-x-lg'></i> Password must <b>match</b>";
    }
}
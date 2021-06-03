var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function () {
    document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function () {
    document.getElementById("message").style.display = "none";
}


// When the user starts to type something inside the password field
myInput.onkeyup = function () {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("text-danger");
        letter.classList.add("text-success");
        letter.innerHTML = "✔ Must have a <b>lowercase</b> letter";
    } else {
        letter.classList.remove("text-success");
        letter.classList.add("text-danger");
        letter.innerHTML = "X Must have a <b>lowercase</b> letter";
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("text-danger");
        capital.classList.add("text-success");
        capital.innerHTML = "✔ Must have a <b>capital (uppercase)</b> letter";
    } else {
        capital.classList.remove("text-success");
        capital.classList.add("text-danger");
        capital.innerHTML = "X Must have a <b>capital (uppercase)</b> letter";
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        number.classList.remove("text-danger");
        number.classList.add("text-success");
        number.innerHTML = "✔ Must have a <b>number</b>";
    } else {
        number.classList.remove("text-success");
        number.classList.add("text-danger");
        number.innerHTML = "X Must have a <b>number</b>";
    }

    // Validate length
    if (myInput.value.length >= 6) {
        length.classList.remove("text-danger");
        length.classList.add("text-success");
        length.innerHTML = "✔ Minimum <b>6 characters</b>";
    } else {
        length.classList.remove("text-success");
        length.classList.add("text-danger");
        length.innerHTML = "X Minimum <b>6 characters</b>";
    }
}
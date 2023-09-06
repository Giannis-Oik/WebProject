function validatePassword() {
    var passwordInput = document.getElementById("password");
    var password = passwordInput.value;
    var passwordError = document.getElementById("passwordError");

    var hasCapitalLetter = /[A-Z]/.test(password);
    var hasNumber = /\d/.test(password);
    var hasSymbol = /[!@#\$%^&*()_+\-=]/.test(password);
    var hasMinLength = password.length >= 8;

    var errorMessages = [];

    if (!hasCapitalLetter) {
        errorMessages.push("The password does not contain a capital letter.");
    }

    if (!hasNumber) {
        errorMessages.push("The password does not contain a number.");
    }

    if (!hasSymbol) {
        errorMessages.push("The password does not contain a symbol.");
    }

    if (!hasMinLength) {
        errorMessages.push("The password must contain at least 8 characters.");
    }

    if (errorMessages.length > 0) {
        var lastMessage = errorMessages.pop(); // Remove the last message
        passwordError.textContent = errorMessages.join(" ") + (errorMessages.length > 0 ? " " : "") + lastMessage + "";
        return false;
    } else {
        passwordError.textContent = "";
        return true;
    }
}

document.querySelector("form").addEventListener("submit", function (e) {
    if (!validatePassword()) {
        e.preventDefault(); // Prevent the form submission if validation fails
    }
});

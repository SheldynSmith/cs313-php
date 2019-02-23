function validateForm() {
    var password1 = document.forms["sign-up"]["password"].value;
    var password2 = document.forms["sign-up"]["password-confirm"].value;
    var username = document.forms["sign-up"]["username"].value;
    var warning = document.getElementById("not-matched");

    if(password1 !== password2) {
        warning.visibility = "visible";
        warning.innerHTML = "Passwords must be the same"
        return false;
    }
    else if(username == "") {
        warning.visibility = "visible";
        warning.innerHTML = "Username must not be blank"
        return false;
    }
    else if(password1 == "" || password2 == "") {
        warning.visibility = "visible";
        warning.innerHTML = "Password must not be blank"
        return false;
    }
}
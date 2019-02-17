<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script>
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
    </script>
    <title>Pathfinder Character Sheet - New User</title>
</head>
<body>
    <h1>Pathfinder Character Sheet</h1>
    <h3>Enter a new username and password</h3>
    <form id="sign-up" method="POST" action="createUser.php" onsubmit="return validateForm()">
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br>
        <label>Confirm Password:</label><br>
        <input type="password" name="password-confirm"><br><br>
        <input type="submit" name="submit" value="Sign Up"><br><br>
        <div id="not-matched" style="color:red" visibility="hidden"></div>
    </form>
</body>
</html>
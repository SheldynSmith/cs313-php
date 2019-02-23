<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/sheet.css">
    <script src="validateScript.js"></script>
    <title>Pathfinder Character Sheet - New User</title>
</head>
<body>
    <div id="content">
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
    </div>
</body>
</html>
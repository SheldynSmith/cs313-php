<?php
session_start();
if(!$_SESSION["retryLogin"]) {
    $_SESSION["verified"] = FALSE;
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = FALSE;
}
$_SESSION["characterID"] = NULL;
$_SESSION["userID"] = NULL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/sheet.css">
    <title>Pathfinder Character Sheet - Login</title>
</head>
<body>
    <div id="content">
        <h1>Pathfinder Character Sheet</h1>
        <h3>Login</h3>
        <form id="login" method="POST" action="user-auth.php">
            <label>Username:</label><br>
            <input type="text" name="username"><br>
            <label>Password:</label><br>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="Sign In"><br>
            <?php
                if($_SESSION["retryLogin"] == TRUE) {
                    echo "<span style=\"color: red\">Invalid username or password</span>";
                    $_SESSION["retryLogin"] = FALSE;
                }
            ?>
        </form><br>
        <a href="newUser.php">Create a new account</a>
    </div>
</body>
</html>
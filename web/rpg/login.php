<?php
// if(!isset($_SESSION)) {
session_start();
if(!$_SESSION["retryLogin"]) {
    $_SESSION["verified"] = FALSE;
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = FALSE;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pathfinder Character Sheet - Login</title>
</head>
<body>
    <h1>Pathfinder Character Sheet</h1>
    <h3>Login</h3>
    <form id="login" method="POST" action="user-auth.php">
        <label>Username:</label><br>
        <input type="text" name="username"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br>
        <input type="submit" name="submit" value="Sign In"><br>
        <?php
            if($_SESSION["retryLogin"] == TRUE) {
                echo "<span style=\"color: red\">Username and password did not match</span>";
            }
        ?>
    </form>
</body>
</html>
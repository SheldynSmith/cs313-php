<?php
    require "dbConnect.php";

    $db = get_db();
    $userName = $_POST["username"];
    $password = $_POST["password"];
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    $statement = $db->prepare("INSERT INTO usertable (username, passwordhash)
                               VALUES (:cleanUsername, :cleanPasswordHash)");
    $statement->bindValue(":cleanUsername", $userName, PDO::PARAM_STR);
    $statement->bindValue(":cleanPasswordHash", $password, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION["verified"] = FALSE;
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = TRUE;
    header("Location: login.php");
    exit;
?>
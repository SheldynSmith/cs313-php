<?php
session_start();
require "dbConnect.php";

$db = get_db();
$userName = $_POST["username"];
$password = $_POST["password"];

$statement = $db->prepare("SELECT id, username, passwordhash FROM usertable WHERE username = :cleanUsername");
$statement->bindValue(":cleanUsername", $userName, PDO::PARAM_STR);
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);
$storedUserName = $row["username"];
$passwordHash = $row["passwordhash"];
$userID = $row["id"];

$passwdIsVerified = password_verify($password, $passwordHash);

if($userName == $storedUserName && $passwdIsVerified) {
    $_SESSION["verified"] = TRUE;
    $_SESSION["username"] = $userName;
    $_SESSION["userID"] = $userID;
    header("Location: user-home.php");
    exit;
}
else {
    $_SESSION["verified"] = FALSE;
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = TRUE;
    $_SESSION["userID"] = NULL;
    header("Location: login.php");
    exit;
}
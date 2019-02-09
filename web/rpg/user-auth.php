<?php
require "dbConnect.php";

$db = get_db();
$userName = $_POST["username"];
$password = $_POST["password"];

$statement = $db->prepare("SELECT username, passwordhash FROM usertable WHERE username = '$userName'");
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);
$storedUserName = $row["username"];
$passwordHash = $row["passwordhash"];

$passwdIsVerified = password_verify($password, $passwordHash);

if($userName == $storedUserName && $passwdIsVerified) {
    $_SESSION["verified"] = TRUE;
    $_SESSION["username"] = $userName;
    echo "User is verified";
}
<?php
session_start();

if(!$_SESSION["verified"]) {
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = FALSE;
    header("Location: login.php");
    exit;
}
$_SESSION["characterID"] = NULL;

require "dbConnect.php";

$userName = $_SESSION["username"];

$db = get_db();
$statement = $db->prepare("INSERT INTO characersheet (charactername)
                           VALUES ('New Character')");
$statement->execute();

header("Location: user-home.php");
exit;
?>
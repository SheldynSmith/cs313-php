<?php
session_start();

if(!$_SESSION["verified"]) {
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = FALSE;
    header("Location: login.php");
    exit;
}
require "dbConnect.php";

$userName = $_SESSION["username"];
$userID = $_SESSION["userID"];

$db = get_db();
$characterID = htmlspecialchars($_GET["id"]);

$statement = $db->prepare("DELETE FROM charactersheets WHERE id = :cleanCharacterID AND userid = :cleanUserID");
$statement->bindValue(":cleanCharacterID", $characterID, PDO::PARAM_STR);
$statement->bindValue(":cleanUserID", $userID, PDO::PARAM_STR);
$statement->execute();

header("Location: user-home.php");
exit;
?>